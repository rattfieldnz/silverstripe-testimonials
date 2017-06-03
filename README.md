# SilverStripe Testimonials

Modified version of the testimonial management and display for a SilverStripe website.

**Note** This is based on the module forked by [i-lateral](https://github.com/i-lateral/silverstripe-testimonials), who in turn forked the module from [burnbright](https://github.com/burnbright/silverstripe-testimonials). The latter fork is said to be 'abandoned'.

## Installation 

### Step 1

Go to the root of your Silverstripe project, and enter :

`composer self-update && composer require rattfieldnz/silverstripe-testimonials-widgets`

### Step 2 

Run the following command to populate your Silverstripe project's database with this module's details: 

`php framework/cli-script.php dev/build flush=all`

### Step 3

On the left-hand side menu, you should see a 'Testimonials'  menu item accompanied with the ![Alt](images/testimonials-icon.png "Testimonials Menu Item") icon. Click on this to add a new testimonial.

The rest should be easy to follow :). Let me know otherwise, and I will add more granular instructions here.

## Features

 * Creation of testimonials that can contain: Content, Name, Business, Date, Show and Image
 * Testimonials holder page that lists Testimonials.
 * Testimonlials widget that can show a random testimonial in the widget area.
 
## Newly added in this fork 

 * Adding list of comma-delimited authors, who are not registered as part of the Silverstripe CMS. 

## Contributing and Feedback

I have just recently started Silverstripe development, and am still learning the awesome ecosystem that it is. If you see anything I have missed, or constructive ideas to make this module better, please contact me and let me know. You can even fork this repo and play with the code yourself too :).
