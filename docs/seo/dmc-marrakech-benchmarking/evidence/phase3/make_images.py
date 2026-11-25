"""Build responsive WebP variants for /dmc-marrakech from existing project assets.
Run from the repo root: python -I make_images.py <scratch_manifest.json>"""
import json, os, sys
from PIL import Image, ImageDraw, ImageFont, ImageFilter

SRC = "assets/img"
OUT = "assets/img/dmc-marrakech"
os.makedirs(OUT, exist_ok=True)

# (key, source file, output base name, aspect (w/h) or None to keep, focal (fx, fy), widths)
JOBS = [
    ("hero", "moroccan-traditional-dinner-event.webp", "dmc-marrakech-hero-lantern-gala-dinner", None, (0.5, 0.5), [640, 960, 1280]),
    ("tile_mice", "morocco-quest-local-sourcing-catering-sustainable-events.webp", "dmc-marrakech-corporate-event-garden-gala", 4/3, (0.62, 0.55), [400, 600]),
    ("tile_incentive", "morocco-quest-camel-caravan-desert-team-building-marrakech.webp", "dmc-marrakech-incentive-camel-caravan", 4/3, (0.5, 0.55), [400, 600]),
    ("tile_conference", "morocco-quest-palais-des-congres-marrakech-pco-hero.webp", "dmc-marrakech-conference-theatre-hall", 4/3, (0.5, 0.5), [400, 600]),
    ("tile_teambuilding", "morocco-quest-team-building-activities-marrakech.webp", "dmc-marrakech-team-building-quad-palm-grove", 4/3, (0.5, 0.6), [400, 600]),
    ("tile_luxury", "morocco-quest-luxury-berber-tent-gala-dinner-agafay-desert.webp", "dmc-marrakech-luxury-desert-tent-dinner", 4/3, (0.5, 0.55), [400, 600]),
    ("tile_transport", "morocco-desert-4x4-adventure-tour-rural-landscape.webp", "dmc-marrakech-transport-4x4-fleet", 4/3, (0.5, 0.75), [400, 600]),
    ("tile_hotels", "morocco-quest-gala-courtyard-riad-night-marrakech.webp", "dmc-marrakech-riad-courtyard-accommodation", 4/3, (0.5, 0.5), [400, 600]),
    ("tile_excursions", "guide-dar-el-bacha-marrakech-tour-moroccan-culture.webp", "dmc-marrakech-guided-visit-dar-el-bacha", 4/3, (0.62, 0.55), [400, 600]),
    ("guide_meetings", "morocco-quest-conference-interpreting-booth-delegate-logistics.webp", "dmc-marrakech-conference-interpreting-booth", 3/2, (0.5, 0.5), [480, 720]),
    ("guide_gala", "morocco-quest-riad-restaurant-service-360-hero.webp", "dmc-marrakech-palace-restaurant-service", 3/2, (0.55, 0.4), [480, 720]),
    ("guide_incentive", "hot-air-balloon-ride-morocco-desert-adventure.webp", "dmc-marrakech-hot-air-balloon-sunrise", 3/2, (0.55, 0.5), [480, 720]),
    ("guide_dining", "morocco-quest-gala-dinner-moroccan-cuisine-mice-marrakech.webp", "dmc-marrakech-moroccan-gala-dinner-cuisine", 3/2, (0.45, 0.5), [480, 720]),
    ("planner", "morocco-quest-marrakech-skyline-atlas-conventions.webp", "dmc-marrakech-jemaa-el-fna-square-dusk", 3/2, (0.5, 0.5), [600, 900]),
    ("sample_conference", "morocco-quest-guests-red-carpet-arrival-event-venue-morocco.webp", "dmc-marrakech-guests-arrival-event-venue", 3/2, (0.5, 0.5), [480, 720]),
    ("sample_incentive", "agafay-desert-luxury-camp-camel-trek-morocco.webp", "dmc-marrakech-agafay-desert-camp", 3/2, (0.55, 0.5), [480, 720]),
    ("sample_sahara", "desert-luxury-camp-morocco-sunset-traditional-tents.webp", "dmc-marrakech-sahara-camp-sunset-extension", 3/2, (0.5, 0.55), [480, 720]),
    ("who", "morocco-quest-marrakech-medina-rooftops-atlas-view.webp", "dmc-marrakech-medina-street-jemaa-el-fna", 4/3, (0.5, 0.5), [600, 900]),
    ("why", "morocco-quest-koutoubia-mosque-marrakech-why-us.webp", "dmc-marrakech-b2b-partnership-handshake", 4/3, (0.45, 0.5), [600, 900]),
    ("coverage", "morocco-quest-atlas-mountain-road-morocco-dmc-hero.webp", "dmc-marrakech-atlas-mountain-road-coverage", 16/9, (0.5, 0.5), [640, 1000]),
]

def crop_to(im, aspect, fx, fy):
    if aspect is None:
        return im
    w, h = im.size
    if w / h > aspect:  # too wide -> crop width
        nw = round(h * aspect); x = round((w - nw) * fx); x = max(0, min(x, w - nw))
        return im.crop((x, 0, x + nw, h))
    nh = round(w / aspect); y = round((h - nh) * fy); y = max(0, min(y, h - nh))
    return im.crop((0, y, w, y + nh))

manifest = {}
for key, src, base, aspect, (fx, fy), widths in JOBS:
    im = Image.open(os.path.join(SRC, src)).convert("RGB")
    im = crop_to(im, aspect, fx, fy)
    out = []
    for wdt in widths:
        if wdt > im.size[0]:
            wdt = im.size[0]  # never upscale
        hgt = round(im.size[1] * wdt / im.size[0])
        v = im.resize((wdt, hgt), Image.LANCZOS)
        path = f"{OUT}/{base}-{wdt}.webp"
        v.save(path, "WEBP", quality=78, method=6)
        out.append({"path": path, "w": wdt, "h": hgt, "kb": round(os.path.getsize(path) / 1024, 1)})
    manifest[key] = {"source": f"{SRC}/{src}", "source_size": list(Image.open(os.path.join(SRC, src)).size), "variants": out}

# Open Graph card 1200x630: hero crop + gradient + text (Rubik if available, else Arial)
hero = Image.open(os.path.join(SRC, "moroccan-traditional-dinner-event.webp")).convert("RGB")
og = crop_to(hero, 1200 / 630, 0.5, 0.45).resize((1200, 630), Image.LANCZOS)
shade = Image.new("L", (1200, 630), 0); d = ImageDraw.Draw(shade)
for x in range(1200):
    d.line([(x, 0), (x, 630)], fill=int(205 * max(0, 1 - x / 900)))
og = Image.composite(Image.new("RGB", og.size, (16, 14, 12)), og, shade)
def font(size, bold=False):
    for f in (["assets/fonts/Rubik-Bold.ttf", "C:/Windows/Fonts/arialbd.ttf"] if bold else ["assets/fonts/Rubik-Regular.ttf", "C:/Windows/Fonts/arial.ttf"]):
        if os.path.exists(f):
            return ImageFont.truetype(f, size)
    return ImageFont.load_default()
d = ImageDraw.Draw(og)
d.rectangle([60, 150, 66, 420], fill=(187, 94, 42))
d.text((90, 150), "DMC Marrakech", font=font(78, True), fill=(255, 255, 255))
d.text((92, 250), "Destination management for travel agents,", font=font(34), fill=(240, 232, 226))
d.text((92, 295), "tour operators & MICE planners", font=font(34), fill=(240, 232, 226))
d.text((92, 375), "MOROCCO QUEST DMC  ·  morocco-quest.com", font=font(26, True), fill=(230, 160, 120))
og_path = f"{OUT}/og-dmc-marrakech-morocco-quest-1200x630.jpg"
og.save(og_path, "JPEG", quality=84, optimize=True, progressive=True)
manifest["og"] = {"source": f"{SRC}/moroccan-traditional-dinner-event.webp (composited)", "variants": [{"path": og_path, "w": 1200, "h": 630, "kb": round(os.path.getsize(og_path) / 1024, 1)}]}

json.dump(manifest, open(sys.argv[1], "w"), indent=1)
total = sum(v["kb"] for m in manifest.values() for v in m["variants"])
print(len(manifest), "assets,", sum(len(m["variants"]) for m in manifest.values()), "files,", round(total), "KB total")
for k, m in manifest.items():
    print(k, [(v["w"], v["h"], v["kb"]) for v in m["variants"]])
