<?php  if (! defined('BASEPATH')) exit('No direct script access allowed');

use League\Glide\Urls\UrlBuilderFactory;

if (! function_exists('company_image'))
{
    /**
     * Convenience wrapper for safe_image function to deal with company (member) images
     *
     * @param string $image
     * @param int|boolean $size
     * @param array $options
     * @return string
     */
    function company_image($image = '', $size = false, $options = array())
    {
        if ($size) {
            $options['max'] = $size;
        }
        return safe_image(USER_IMAGE_PATH, $image, USER_NO_IMAGE_PATH . ORGANIZATION_IMAGE_PLACEHOLDER, $options);
    }
}

if (! function_exists('store_item_image'))
{
    /**
     * Convenience wrapper for safe_image function to deal with store item images
     *
     * @param string $image
     * @param int|boolean $size
     * @param array $options
     * @return string
     */
    function store_item_image($image = '', $size = false, $options = array())
    {
        if ($size) {
            $options['max'] = $size;
        }
        return safe_image(STORE_IMAGE_PATH, $image, STORE_NO_IMAGE_PATH . STORE_ITEM_IMAGE_PLACEHOLDER, $options);
    }
}

if (! function_exists('project_image'))
{
    /**
     * Convenience wrapper for safe_image function to deal with project images
     *
     * @param string $image
     * @param int|boolean $size
     * @param array $options
     * @return string
     */
    function project_image($image = '', $size = false, $options = array())
    {
        if ($size) {
            $options['max'] = $size;
        }
        return safe_image(PROJECT_IMAGE_PATH, $image, PROJECT_NO_IMAGE_PATH . PROJECT_IMAGE_PLACEHOLDER, $options);
    }
}

if (! function_exists('expert_image'))
{
    /**
     * Convenience wrapper for safe_image function to deal with expert (member) images
     *
     * @param string $image
     * @param int|boolean $size
     * @param array $options
     * @return string
     */
    function expert_image($image = '', $size = false, $options = array())
    {
        if ($size) {
            $options['max'] = $size;
        }
        return safe_image(USER_IMAGE_PATH, $image, USER_NO_IMAGE_PATH . USER_IMAGE_PLACEHOLDER, $options);
    }
}

if (! function_exists('forum_image'))
{
    /**
     * Convenience wrapper for safe_image function to deal with forum (member) images
     *
     * @param string $image
     * @param int|boolean $size
     * @param array $options
     * @return string
     */
    function forum_image($image = '', $size = false, $options = array() )
    {

        if ($size) {
            $options['max'] = $size;
        }
        return safe_image(FORUM_IMAGE_PATH, $image, FORUM_NO_IMAGE_PATH . FORUM_IMAGE_PLACEHOLDER, $options);
    }
}

if (! function_exists('map_image'))
{
    /**
     * Convenience wrapper for safe_image function to deal with map (member) images
     *
     * @param string $image
     * @param int|boolean $size
     * @param array $options
     * @return string
     */
    function map_image($image = '', $size = false, $options = array() )
    {

        if ($size) {
            $options['max'] = $size;
        }
        return safe_image(MAPS_IMAGE_PATH, $image, MAPS_NO_IMAGE_PATH . MAPS_IMAGE_PLACEHOLDER, $options);
    }
}

if (! function_exists('book_image'))
{
    /**
     * Convenience wrapper for safe_image function to deal with expert (member) images
     *
     * @param string $image
     * @param int|boolean $size
     * @param array $options
     * @return string
     */
    function book_image($image = '', $size = false, $options = array())
    {
        if ($size) {
            $options['max'] = $size;
        }
        return safe_image(BOOK_IMAGE_PATH, $image, BOOK_NO_IMAGE_PATH . BOOK_IMAGE_PLACEHOLDER, $options);
    }
}

if (! function_exists('safe_image'))
{
    /**
     * @param string $imageDirectory
     * @param string $imageFilename
     * @param string $fallback
     * @param array $options
     * @return string
     */
    function safe_image($imageDirectory, $imageFilename = null, $fallback = null, $mixedFormatOptions = null)
    {

        $glideOptions = [];

        $permissibleGlideOptions  = array_flip([
            'or',
            'crop',
            'w',
            'h',
            'fit',
            'dpr',
            'bri',
            'con',
            'gam',
            'sharp',
            'blur',
            'pixel',
            'filt',
            'mark',
            'markw',
            'markh',
            'markx',
            'marky',
            'markpad',
            'markpos',
            'markalpha',
            'bg',
            'border',
            'q',
            'fm'
        ]);

        // Convert options in CE Image format into Glide format, 
        // then merge in any remaining options that are in the Glide format already
        if (! is_null($mixedFormatOptions) && is_array($mixedFormatOptions)) {
            // Convert 'max' to 'w' and 'h'
            if (isset($mixedFormatOptions['max'])) {
                $glideOptions['w'] = $mixedFormatOptions['max'];
                $glideOptions['h'] = $mixedFormatOptions['max'];
                unset($mixedFormatOptions['max']);
            }

            // To convert bg_color, remove the leading # and convert to upper case
            if (isset($mixedFormatOptions['bg_color'])) {
                $glideOptions['bg'] = strtoupper(ltrim($mixedFormatOptions['bg_color'], '#'));
                unset($mixedFormatOptions['bg_color']);
            }

            if (isset($mixedFormatOptions['width'])) {
                $glideOptions['w'] = $mixedFormatOptions['width'];
                unset($mixedFormatOptions['width']);
            }

            // If there are other options provided, check they are a valid Glide option
            $glideFormatOptions = array_intersect_key($mixedFormatOptions, $permissibleGlideOptions);
            // Then merge them in
            $glideOptions = array_merge($glideFormatOptions, $glideOptions);
        }

        // Check image is set and file exists 
        if (! is_null($imageFilename) && $imageFilename != '' && is_file(ltrim($imageDirectory, '/') . $imageFilename)) {
            $retrievalDirectoryPath = str_replace(IMAGE_PATH, IMAGE_RETRIEVAL_PATH, $imageDirectory);
            $urlBuilder = UrlBuilderFactory::create($retrievalDirectoryPath, config_item('glide_image_signature'));
            $url = $urlBuilder->getUrl($imageFilename, $glideOptions);
            return $url;
        }

        // Main image doesn't exist, so let's use the fallback, if provided
        if (! is_null($fallback) && $fallback != '') {
            $finalSlash = strrpos($fallback, '/');
            $fallbackFilename = substr($fallback, $finalSlash + 1);
            $fallbackDirectory = substr($fallback, 0, $finalSlash + 1);
            $retrievalDirectoryPath = str_replace(IMAGE_PATH, IMAGE_RETRIEVAL_PATH, $fallbackDirectory);
            $urlBuilder = UrlBuilderFactory::create($retrievalDirectoryPath, config_item('glide_image_signature'));
            $url = $urlBuilder->getUrl($fallbackFilename, $glideOptions);
            return $url;   
        }

        // If there's no valid image provided nor a fallback, return empty string
        return '';
    }
}
