<?php

namespace silverorange\DevTest\Validation;

/**
 * Class for URL validation.
 *
 * Probably should use an external component here.
 *
 */

class URLValidator
{
    /**
   * Validate a url. Note that this is vastly incomplete. Included only for completions sake.
   *
   */
  public function validate($url)
  {
      // NOTE: This should really check encoding.
    if (filter_var(FILTER_VALIDATE_URL, $url) !== false) {
        return true;
    } else {
        return false;
    }
  }

  /**
   * Normalize a url
   *
   * Again only included for completion. Should use real normalizer.
   */
  public function normalize($url)
  {
      str_replace("http://", "", $url);
      str_replace("https://", "", $url);
      str_replace("www.", "", $url);

      return $url;
  }
}
