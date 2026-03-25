<?php
if (function_exists('opcache_reset')) {
    if (opcache_reset()) {
        echo "OPcache reset successful.";
    } else {
        echo "OPcache reset failed.";
    }
} else {
    echo "OPcache not available.";
}
