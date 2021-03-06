<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
?>

<div id="page">
    <?php
        if($secondary_menu):
    ?>
    <div id="secondary-menu-wrapper">
        <nav>
            <?php print theme('links__system_secondary_menu', array('links' => $secondary_menu, 'attributes' => array('id' => 'secondary-menu', 'class' => array('links', 'inline', 'clearfix')))); ?>
        </nav>
    </div>
    <?php
        endif;
    ?>
    <header>
        <section class="section clearfix">

            <?php if ($logo): ?>
                <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
                    <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
                </a>
            <?php endif; ?>

            <?php if ($main_menu): ?>
                <nav id="main-navigation">
                    <?php print theme('links__system_main_menu', array('links' => $main_menu, 'attributes' => array('id' => 'main-menu', 'class' => array('links', 'inline', 'clearfix')))); ?>
                </nav> <!-- /.section, /#navigation -->
            <?php endif; ?>

        </section>
    </header> <!-- /.section, /#header -->

    <?php if ($breadcrumb): ?>
        <div id="breadcrumb-wrap">
            <div id="breadcrumb">
                <?php print $breadcrumb; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if($messages): ?>
    <div class="messages-wrapper">
        <?php print $messages; ?>
    </div>
    <?php
        endif;
    ?>

    <?php if ($page['slider']){ ?>
        <!-- Slider -->
        <div id="slider-wrap">
            <div id="slider">
                <?php print render($page['slider']); ?>
            </div>
        </div>
        <!-- /Slider -->
    <?php }; ?>

    <div id="main-wrapper">
        <?php
            if ($page['sidebar_first']){
                $mainClass = "leftSidebar";
            } else if($page['sidebar_second']){
                $mainClass = "rightSidebar";
            } else if($page['sidebar_first'] && $page['sidebar_second']){
                $mainClass = "bthSidebar";
            } else {
                $mainClass = "noSidebars";
            }
        ?>
        <main id="main" class="clearfix <?php echo $mainClass; ?>">

            <?php if ($page['sidebar_first']): ?>
                <aside id="sidebar-first" class="column sidebar">
                    <div class="section">
                        <?php print render($page['sidebar_first']); ?>
                    </div>
                </aside> <!-- /.section, /#sidebar-first -->
            <?php endif; ?>

            <article id="content" class="column">
                <div class="section">
                    <?php if (isset($page['highlighted'])){ ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php }; ?>
                    <a id="main-content"></a>
                    <?php print render($title_prefix); ?>
                    <?php if ($title): ?><h1 class="title" id="page-title"><?php print $title; ?></h1><?php endif; ?>
                    <?php print render($title_suffix); ?>
                    <?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
                    <?php print render($page['help']); ?>
                    <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
                    <?php print render($page['content']); ?>
                    <?php print $feed_icons; ?>
                </div>
            </article> <!-- /.section, /#content -->

            <?php if ($page['sidebar_second']): ?>
                <aside id="sidebar-second" class="column sidebar">
                    <div class="section">
                        <?php print render($page['sidebar_second']); ?>
                    </div>
                </aside> <!-- /.section, /#sidebar-second -->
            <?php endif; ?>

        </main>
    </div>
    <div id="to-top-wrapper">
        <div id="to-top-container">
            <div id="to-top"></div>
        </div>
    </div>
    <footer>
        <section>
            <div id="footer-logo">
                <img src="/sites/default/themes/euclid_2/img/logo_white.png" />
                <p>
                    www.euclids-project.eu
                </p>
            </div>
            <div id="footer-links">
                <?php print render($page['footer']); ?>
            </div>
        </section>
    </footer>
    <footer id="social-footer">
        <section>
            <div id="copyright">
                <p>
                    Euclids &copy; <?php echo date("Y"); ?> All Rights Reserved  |  Website by <a href="http://energyhousedigital.co.uk" target="_blank">eHd</a>
                </p>
            </div>
            <a href="https://twitter.com/intent/follow?original_referer=http%3A%2F%2Fwww.euclids-project.eu%2F&amp;region=follow_link&amp;screen_name=EUCLIDS_FP7&amp;tw_p=followbutton" target="_blank">
                <div id="twitterLogo" class="first">

                </div>
            </a>
            <a href="/user">
                <div id="myaccountLink" class="last">

                </div>
            </a>
        </section>
    </footer><!-- /.section, /#footer -->

</div> <!-- /#page, /#page-wrapper -->
