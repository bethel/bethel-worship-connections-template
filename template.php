<?php if (!defined('ABSPATH')) exit; ?>

<div class="row">
    <div class="large-6 small-5 columns">
        <?php
        // print the image
        if ($entry->getImageDisplay()) {
            $atts = array();
            $atts['class'] = 'picture';
            $atts['alt'] = __('Photo of', 'connections') . ' ' . $entry->getName();
            $atts['title'] = __('Photo of', 'connections') . ' ' . $entry->getName();
            $atts['height'] = 200;
            $atts['width'] = 300;
            $atts['zc'] = 1;

            $links = $entry->getLinks(array('image' => TRUE));

            if (!empty($links)) {
                $link = $links[0];
                $atts['anchor'] = sprintf('<a href="%1$s"%2$s%3$s>',
                    $link->url,
                    empty($link->target) ? '' : ' target="' . $link->target . '"',
                    empty($link->followString) ? '' : ' rel="' . $link->followString . '"'
                );
            }

            $atts['src'] = WP_CONTENT_URL . '/connections_templates/timthumb.php?src=' . urlencode($entry->getOriginalImageURL('photo'))
                . '&amp;h=' . $atts['height']
                . '&amp;w=' . $atts['width']
                . '&amp;zc=' . $atts['zc'];

            $image = sprintf('<img src="%1$s" width="%2$d" height="%3$d" class="%4$s" alt="%5$s" title="%6$s"/>',
                $atts['src'],
                $atts['width'],
                $atts['height'],
                $atts['class'],
                $atts['alt'],
                $atts['title']);

            if (!empty($atts['anchor'])) {
                echo sprintf($atts['anchor'] . $image . '</a>');
            } else {
                echo $image;
            }
        }
        ?>
    </div>

    <div class="large-6 small-7 columns">

        <div style="clear:both;"></div>
        <div style="margin-bottom: 10px;">
            <span><strong><?php echo $entry->getNameBlock(); ?></strong></span>
            <?php $entry->getTitleBlock(); ?>
        </div>

        <?php $entry->getEmailAddressBlock(array('format' => '%address%')); ?>
        <?php $entry->getPhoneNumberBlock(array('format' => '%number%')); ?>
        <?php $entry->getAddressBlock(); ?>
        <?php $entry->getFamilyMemberBlock(); ?>
        <?php $entry->getImBlock(); ?>
        <?php $entry->getSocialMediaBlock(); ?>
        <?php $entry->getLinkBlock(array('format' => '%title%')); ?>
        <?php $entry->getDateBlock(); ?>

        <?php $department = $entry->getDepartment(); ?>
        <?php if(!empty($department)): ?>
            <span class="org"><span class="organizational-unit"><?php echo $department; ?></span></span>
        <?php endif; ?>
    </div>
</div>
