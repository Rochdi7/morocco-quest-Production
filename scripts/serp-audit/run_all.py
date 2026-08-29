"""Run the full pipeline: SERP scrape -> on-page crawl -> analysis.

Usage:
  python run_all.py --mine https://morocco-quest.com/dmc-marrakech
  python run_all.py --mine <url> --skip-serp     # reuse existing SERP data
"""
from __future__ import annotations

import argparse
import subprocess
import sys
from pathlib import Path

BASE = Path(__file__).resolve().parent
PY = sys.executable


def run(script: str, *args: str) -> int:
    cmd = [PY, "-X", "utf8", str(BASE / script), *args]
    print(f"\n{'='*70}\n$ {' '.join(cmd[2:])}\n{'='*70}")
    return subprocess.call(cmd, cwd=str(BASE))


def main() -> int:
    ap = argparse.ArgumentParser()
    ap.add_argument("--mine", required=True, help="Your page URL")
    ap.add_argument("--top", type=int, default=10)
    ap.add_argument("--limit", type=int, default=40)
    ap.add_argument("--skip-serp", action="store_true")
    ap.add_argument("--from-cache", action="store_true")
    args = ap.parse_args()

    if not args.skip_serp:
        rc = run("serp_scrape.py")
        if rc == 2:
            print("\n!! Google blocked the scrape. Raw HTML saved in ./cache/.")
            print("   Wait, or solve the CAPTCHA once in the headed window "
                  "(the profile persists), then re-run.")
            return 2
        if rc != 0:
            print("\n! SERP scrape failed; aborting.")
            return rc

    crawl_args = ["--mine", args.mine, "--limit", str(args.limit)]
    if args.from_cache:
        crawl_args.append("--from-cache")
    rc = run("onpage_crawl.py", *crawl_args)
    if rc != 0:
        print("\n! Crawl failed; aborting.")
        return rc

    rc = run("analyze.py", "--top", str(args.top))
    if rc == 0:
        out = BASE / "out"
        print(f"\n{'='*70}\nDeliverables:")
        for f in ("serp_results.csv", "serp_unique_domains.csv",
                  "onpage_audit.csv", "keyword_frequency.csv", "gap_report.md"):
            p = out / f
            mark = "OK " if p.exists() else "-- "
            size = f"{p.stat().st_size:,}b" if p.exists() else "missing"
            print(f"  [{mark}] {f:28} {size}")
    return rc


if __name__ == "__main__":
    sys.exit(main())
