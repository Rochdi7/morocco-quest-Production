import requests, time, json, re, sys, hashlib
from urllib.parse import urljoin, urlparse, urldefrag
from urllib import robotparser
from bs4 import BeautifulSoup
OUT=sys.argv[1]
BASE="https://morocco-quest.com"
UA="Mozilla/5.0 (compatible; MQ-SEO-Audit/1.0; read-only)"
rp=robotparser.RobotFileParser(BASE+"/robots.txt"); rp.read()
s=requests.Session(); s.headers["User-Agent"]=UA
sm=s.get(BASE+"/sitemap.xml",timeout=30).text
sitemap_urls=re.findall(r"<loc>\s*([^<\s]+)\s*</loc>",sm)
queue=list(dict.fromkeys([BASE+"/"]+sitemap_urls)); seen=set(queue); pages={}; inlinks={}
SKIP=re.compile(r"\.(jpg|jpeg|png|gif|webp|svg|pdf|zip|css|js|ico|mp4|avif|xml|txt)(\?|$)",re.I)
def norm(u):
    u=urldefrag(u)[0]
    return u
while queue and len(pages)<500:
    u=queue.pop(0)
    if not rp.can_fetch("*",u): pages[u]={"url":u,"blocked":True}; continue
    t=time.time()
    try: r=s.get(u,timeout=30,allow_redirects=False)
    except Exception as e: pages[u]={"url":u,"error":str(e)}; continue
    rec={"url":u,"status":r.status_code,"ms":int((time.time()-t)*1000),"in_sitemap":u in sitemap_urls,"bytes":len(r.content),"xrobots":r.headers.get("X-Robots-Tag")}
    if r.is_redirect or r.status_code in (301,302,307,308):
        loc=urljoin(u,r.headers.get("Location","")); rec["location"]=loc
        if urlparse(loc).netloc==urlparse(BASE).netloc and loc not in seen: seen.add(loc); queue.append(loc)
        pages[u]=rec; time.sleep(1); continue
    if "text/html" in r.headers.get("Content-Type","") and r.status_code==200:
        soup=BeautifulSoup(r.text,"lxml")
        g=lambda sel,attr="content": (soup.select_one(sel) or {}).get(attr) if soup.select_one(sel) else None
        rec["lang"]=soup.html.get("lang") if soup.html else None
        rec["title"]=soup.title.get_text(strip=True) if soup.title else None
        rec["desc"]=g('meta[name="description"]')
        rec["robots"]=g('meta[name="robots"]')
        rec["canonical"]=g('link[rel="canonical"]',"href")
        rec["og_image"]=g('meta[property="og:image"]')
        rec["hreflang"]=[(l.get("hreflang"),l.get("href")) for l in soup.select('link[rel="alternate"][hreflang]')]
        rec["h1"]=[h.get_text(" ",strip=True) for h in soup.find_all("h1")]
        rec["h2"]=[h.get_text(" ",strip=True) for h in soup.find_all("h2")][:25]
        lds=[]
        for sc in soup.find_all("script",type="application/ld+json"):
            try:
                d=json.loads(sc.string or "")
                items=d.get("@graph",[d]) if isinstance(d,dict) else d
                for it in items: lds.append(it.get("@type") if isinstance(it,dict) else None)
            except Exception as e: lds.append("PARSE_ERROR")
        rec["jsonld"]=lds
        imgs=soup.find_all("img"); rec["imgs"]=len(imgs); rec["img_noalt"]=sum(1 for i in imgs if not (i.get("alt") or "").strip())
        body=soup.find("body")
        for x in (body or soup).find_all(["script","style","noscript"]): x.decompose()
        main=soup.find("main") or body
        txt=(main.get_text(" ",strip=True) if main else "")
        rec["words"]=len(txt.split())
        rec["text_hash"]=hashlib.md5(txt[:3000].encode()).hexdigest()
        rec["text_sample"]=txt[:600]
        links=[]
        for a in soup.find_all("a",href=True):
            h=norm(urljoin(u,a["href"]))
            if urlparse(h).scheme not in ("http","https"): continue
            internal=urlparse(h).netloc in ("morocco-quest.com","www.morocco-quest.com")
            links.append((h,a.get_text(" ",strip=True)[:80],internal))
            if internal:
                inlinks.setdefault(h,[]).append((u,a.get_text(" ",strip=True)[:60]))
                if h not in seen and not SKIP.search(h) and "?" not in h:
                    seen.add(h); queue.append(h)
                elif "?" in h: rec.setdefault("param_links",[]).append(h)
        rec["internal_out"]=len({l[0] for l in links if l[2]}); rec["external_out"]=sorted({l[0] for l in links if not l[2]})
    pages[u]=rec
    print(len(pages),r.status_code,rec["ms"],u,flush=True)
    time.sleep(1)
json.dump({"sitemap_urls":sitemap_urls,"pages":pages,"inlinks":inlinks,"queue_left":queue},open(OUT,"w",encoding="utf-8"),ensure_ascii=False,indent=1)
print("DONE",len(pages),"left",len(queue))
