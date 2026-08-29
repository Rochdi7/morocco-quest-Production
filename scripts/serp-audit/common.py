"""Shared config, paths and helpers for the SERP competitive audit tool."""
from __future__ import annotations

import hashlib
import os
import random
import re
import time
from pathlib import Path
from urllib.parse import urlparse

BASE = Path(__file__).resolve().parent
CACHE = BASE / "cache"
OUT = BASE / "out"
PROFILE = BASE / "profile"
for _d in (CACHE, OUT, PROFILE):
    _d.mkdir(parents=True, exist_ok=True)

QUERY = "dmc marrakech"
GL = "ma"
HL = "en"
PAGES = 10

USER_AGENT = (
    "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 "
    "(KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36"
)

# Google-internal hosts that are never real organic competitors.
GOOGLE_HOSTS = (
    "google.com", "google.co", "google.", "maps.google", "accounts.google",
    "policies.google", "support.google", "webcache.googleusercontent.com",
    "translate.google", "books.google", "news.google",
)

SERP_MIN_DELAY, SERP_MAX_DELAY = 3.0, 8.0
CRAWL_MIN_DELAY = 2.0


def jitter(lo: float = SERP_MIN_DELAY, hi: float = SERP_MAX_DELAY) -> None:
    """Randomised sleep between SERP page fetches."""
    time.sleep(random.uniform(lo, hi))


def domain_of(url: str) -> str:
    try:
        host = urlparse(url).netloc.lower()
    except ValueError:
        return ""
    return host[4:] if host.startswith("www.") else host


def is_google_internal(url: str) -> bool:
    host = urlparse(url).netloc.lower() if url else ""
    if not host:
        return True
    return any(g in host for g in GOOGLE_HOSTS)


def cache_path(url: str, suffix: str = ".html") -> Path:
    """Stable on-disk cache filename for a URL."""
    h = hashlib.sha1(url.encode("utf-8")).hexdigest()[:16]
    slug = re.sub(r"[^a-z0-9]+", "-", domain_of(url))[:40].strip("-") or "page"
    return CACHE / f"{slug}-{h}{suffix}"


def read_cache(url: str, suffix: str = ".html") -> str | None:
    p = cache_path(url, suffix)
    if p.exists() and p.stat().st_size > 0:
        return p.read_text(encoding="utf-8", errors="replace")
    return None


def write_cache(url: str, html: str, suffix: str = ".html") -> Path:
    p = cache_path(url, suffix)
    p.write_text(html, encoding="utf-8", errors="replace")
    return p


def looks_blocked(html: str) -> bool:
    """Detect Google CAPTCHA / 'unusual traffic' interstitials.

    Deliberately narrow: a normal SERP embeds Google's own block-HANDLING
    JavaScript, which mentions "/sorry/index" and "X-Sorry-Redirect". Matching
    those substrings flags every healthy page, so we check the page identity
    (title / visible copy / an actual captcha form) instead.
    """
    if not html:
        return True
    low = html.lower()

    # A real interstitial says so in the <title>.
    m = re.search(r"<title[^>]*>(.*?)</title>", low, re.S)
    title = (m.group(1) if m else "").strip()
    if title and ("sorry" in title or "unusual traffic" in title):
        return True

    # Visible block copy.
    phrases = (
        "our systems have detected unusual traffic",
        "detected unusual traffic from your computer network",
        "unusual traffic from your computer network",
        "to continue, please type the characters",
    )
    if any(p in low for p in phrases):
        return True

    # An actual captcha form (not a mention of one in a script).
    if re.search(r'<form[^>]+(id=["\']captcha-form|action=["\'][^"\']*/sorry/)', low):
        return True
    if "g-recaptcha" in low and "<form" in low:
        return True

    return False
