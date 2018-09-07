# Modifying the IEEE website

## Accessing the site files through CPanel

1. Go to [Namecheap CPanel](http://cpanel.ieeecornell.org/) and log in. Username is `ieeecegp`.
2. Click on the File Manager
3. The Wordpress install lives under `public_html`.
4. Note that what's in the File Manager might not be 100% in sync with what's on GitHub--there's no automated deployment.

## Adding an event to the calendar

1. Go to the [Wordpress dashboard](http://ieeecornell.org/wp-admin/) and log in. Username is `aag233`.
2. In the sidebar go to Events -> Add New.

## Editing the executive board page

1. Go to Pages in the Wordpress dashboard.
2. Find "Executive Board" and click Edit.
3. Use the text editor to make changes. An person's markup uses [custom Wordpress tags](https://developer.wordpress.org/themes/basics/categories-tags-custom-taxonomies/) to make things easy. Sample markup:
  ```
  [eboard_member name="Angus Gibbs" img="http://ieeecornell.org/wp-content/uploads/2016/02/AngusGibbs.png"]
  ```
  
## Todos

1. Move off Wordpress, probably to a static site generator.
2. Move off Namecheap--can probably get a cheaper rate somewhere else. Could also probably pay for just the domain and host on AWS, might even be able to host for free as a student.
