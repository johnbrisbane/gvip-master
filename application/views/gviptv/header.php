<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js gte-ie9" lang="en"> <!--<![endif]-->
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="GViP is a global platform connecting infrastructure project developers with experts. GViP has over 800 projects and over 1000 experts. Sign up to connect with leading experts." />
    <meta name="viewport" content="width=device-width" />

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <title><?php echo empty($title) ? SITE_NAME : $title ?></title>

    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css" />

    <?php echo link_tag('css/style.css' . asset_version('style.css')) ?>

    <script src="/js/modernizr.js" type="text/javascript" ></script>
    <script>
        !function(){var analytics=window.analytics=window.analytics||[];if(!analytics.initialize)if(analytics.invoked)window.console&&console.error&&console.error("Segment snippet included twice.");else{analytics.invoked=!0;analytics.methods=["trackSubmit","trackClick","trackLink","trackForm","pageview","identify","reset","group","track","ready","alias","debug","page","once","off","on","addSourceMiddleware","addIntegrationMiddleware","setAnonymousId","addDestinationMiddleware"];analytics.factory=function(e){return function(){var t=Array.prototype.slice.call(arguments);t.unshift(e);analytics.push(t);return analytics}};for(var e=0;e<analytics.methods.length;e++){var key=analytics.methods[e];analytics[key]=analytics.factory(key)}analytics.load=function(key,e){var t=document.createElement("script");t.type="text/javascript";t.async=!0;t.src="https://cdn.segment.com/analytics.js/v1/" + key + "/analytics.min.js";var n=document.getElementsByTagName("script")[0];n.parentNode.insertBefore(t,n);analytics._loadOptions=e};analytics.SNIPPET_VERSION="4.13.1";
         analytics.load("1qbuQWdL8PwncN0KTqCvbI5SVerpPW0v");
        analytics.page();
        }}();
    </script>

    <?php $this->load->view('templates/_segment_analytics', empty($page_analytics) ? array() : $page_analytics);?>

    <?php if (isset($header_extra) && $header_extra != '') echo $header_extra; ?>
</head>

<body id="<?php echo isset($bodyid) ? $bodyid : '' ?>" class="<?php echo isset($bodyclass) ? $bodyclass : '' ?>">
<div class="wrapper">

    <?php $this->load->view('layouts/header') ?>
