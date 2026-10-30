import json,sys,collections,re
d=json.load(open(sys.argv[1],encoding='utf-8'))
P=d['pages'];SM=set(d['sitemap_urls']);IN=d['inlinks']
st=collections.Counter(p.get('status') for p in P.values())
print('pages',len(P),'status',dict(st),'sitemap',len(SM),'queue_left',len(d['queue_left']))
html=[p for p in P.values() if p.get('status')==200 and 'title' in p]
def idx(p):
    r=(p.get('robots') or '').lower()+(p.get('xrobots') or '').lower()
    return 'noindex' not in r
def canon_ok(p): return (p.get('canonical') or '')==p['url']
indexable=[p for p in html if idx(p) and canon_ok(p)]
print('html200',len(html),'indexable(self-canon,no noindex)',len(indexable))
print('\n== non-200 ==')
for p in P.values():
    if p.get('status')!=200: print(p.get('status'),p['url'],'->',p.get('location'),'| inlinks:',len(IN.get(p['url'],[])),'| from e.g.',[x[0] for x in IN.get(p['url'],[])][:2])
print('\n== sitemap URLs not 200/indexable ==')
for u in SM:
    p=P.get(u)
    if not p: print('NOT CRAWLED',u); continue
    if p.get('status')!=200 or not idx(p) or not canon_ok(p): print(p.get('status'),u,'robots',p.get('robots'),'canon',p.get('canonical'))
print('\n== indexable not in sitemap ==')
for p in indexable:
    if p['url'] not in SM: print(p['url'])
print('\n== canonical != url ==')
for p in html:
    if not canon_ok(p): print(p['url'],'->',p.get('canonical'),'| robots',p.get('robots'))
def dup(key):
    c=collections.defaultdict(list)
    for p in indexable:
        v=p.get(key)
        if isinstance(v,list): v=' | '.join(v)
        if v: c[v.strip().lower()].append(p['url'])
    return {k:v for k,v in c.items() if len(v)>1}
for k in ['title','desc','h1','text_hash']:
    print(f'\n== duplicate {k} among indexable ==')
    for v,us in dup(k).items(): print(' ',repr(v[:90]),us)
print('\n== H1 count != 1 ==')
for p in indexable:
    if len(p['h1'])!=1: print(len(p['h1']),p['url'],p['h1'][:3])
print('\n== missing title/desc ==')
for p in indexable:
    if not p.get('title') or not p.get('desc'): print(p['url'],bool(p.get('title')),bool(p.get('desc')))
print('\n== thin (<300 words main) indexable ==')
for p in sorted(indexable,key=lambda p:p['words']):
    if p['words']<300: print(p['words'],p['url'])
print('\n== title length >65 or <30; desc >160 or <70 ==')
for p in indexable:
    t=len(p.get('title') or '');ds=len(p.get('desc') or '')
    if t>65 or t<30 or ds>165 or ds<70: print(t,ds,p['url'],'|',p.get('title'))
print('\n== img no alt ==')
for p in indexable:
    if p.get('img_noalt'): print(p['img_noalt'],'/',p['imgs'],p['url'])
print('\n== inlinks for indexable (unique source pages), lowest 40 ==')
cnt={p['url']:len({s for s,_ in IN.get(p['url'],[]) if s!=p['url']}) for p in indexable}
for u,c in sorted(cnt.items(),key=lambda x:x[1])[:40]: print(c,u)
print('\n== lang/hreflang ==',collections.Counter(p.get('lang') for p in html),sum(1 for p in html if p.get('hreflang')))
print('\n== jsonld types ==',collections.Counter(t if isinstance(t,str) else str(t) for p in html for t in p.get('jsonld',[])))
print('\n== param links found ==',sorted({u for p in html for u in p.get('param_links',[])})[:30])
print('\n== external domains ==',collections.Counter(re.sub(r'https?://([^/]+).*',r'\1',u) for p in html for u in p.get('external_out',[])).most_common(40))
print('\n== slow pages >2500ms ==',[(p['ms'],p['url']) for p in html if p['ms']>2500])
