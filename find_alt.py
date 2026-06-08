import re, sys
sys.stdout.reconfigure(encoding="utf-8")
from pathlib import Path

files = {
    "trips.blade.php": "resources/views/trips.blade.php",
    "home.blade.php": "resources/views/home.blade.php",
    "activity-categories.blade.php": "resources/views/activity-categories.blade.php",
    "trips-details.blade.php": "resources/views/trips-details.blade.php",
    "blog-details.blade.php": "resources/views/blog-details.blade.php",
    "activity-detail.blade.php": "resources/views/activity-detail.blade.php",
    "tour-detail.blade.php": "resources/views/tour-detail.blade.php",
}

for label, rel in files.items():
    text = Path(rel).read_text(encoding="utf-8", errors="replace")
    lines = text.splitlines()
    imgs = []
    for i, line in enumerate(lines, 1):
        if re.search(r"<img\s", line, re.IGNORECASE):
            if "aria-hidden" not in line and not re.search(r'alt=["\']', line):
                # check if it's a multiline img — grab surrounding 3 lines
                block = " ".join(lines[max(0,i-2):i+2])
                if not re.search(r'alt=["\']', block):
                    imgs.append((i, line.strip()[:120]))
    if imgs:
        print(f"\n--- {label} ---")
        for lineno, snip in imgs:
            print(f"  L{lineno}: {snip}")
