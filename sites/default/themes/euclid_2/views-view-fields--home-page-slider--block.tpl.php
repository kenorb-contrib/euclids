<?php

/**
 * @file
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */

$image = $fields["field_slider_image"]->content;
$file = file_load($image);
$image = file_create_url($file->uri);

$title = $fields["title"]->content;
$body = $fields["body"]->content;
$field_websitelink = $fields["field_websitelink"]->content;
$button_label = $fields["field_button_title"]->content;

?>
<div id="slide_<?php echo $view->row_index; ?>" class="banner_outer" style="background-image: url(<?php echo $image; ?>);">
    <div class="banner_text">
        <?php
            echo $title;
        ?>
        <?php
            echo $body;
        ?>
<?php
   if($field_websitelink != NULL){

       $link = explode('href="',$field_websitelink);
       $link = explode('"',$link[1]);
       $link = $link[0];

?>
       <a href="<?php echo $link; ?>" class="slider_readmore">
           Learn More
       </a>
<?php
   }; // end if link
?>
    </div>
    <div class="slider_button" slide="slide_<?php echo $view->row_index; ?>">
        <?php echo $button_label; ?>
    </div>
</div>