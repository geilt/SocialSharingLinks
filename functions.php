/**
 * Example with Wordpress
 * @type {[type]}
 */

$url = get_the_permalink();
$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail' );
$description = get_the_excerpt();
$title = get_the_title();

echo get_share_link($url, $image, $title, $description, 'facebook');
echo get_share_link($url, $image, $title, $description, 'twitter');
echo get_share_link($url, $image, $title, $description, 'reddit');

/**
 * Get Share Link. Named using Wordpress Conventions, change to suit your purpose.
 * @param  {string} $url         The sharing URL
 * @param  {string} $image       Force the image on some networks (Otherwise Tags/OpenGraph)
 * @param  {string} $title       Title used over description by some networks depending on restrictions
 * @param  {string} $description Description used for some networks
 * @param  {string} $network     The network for this link.
 * @return {string}              Fully qualified url to create a link with.
 */
if(!function_exists('get_share_link')){
	function get_share_link($url, $image, $title, $description, $network){
		switch($network):
			case 'twitter':
				return 'https://twitter.com/intent/tweet?text=' . urlencode($title . ' ' . $url . '?network=twitter');
				break;
			case 'facebook':
				return 'http://www.facebook.com/sharer.php?s=100' . 
					'&p[url]=' . urlencode($url . '?network=facebook') .
					'&p[title]=' . urlencode($title) . 
					'&p[images][0]=' . urlencode($image) . 
					'&p[summary]=' . urlencode($description);
				break;
			case 'reddit':
				return 'http://www.reddit.com/submit?title=' . urlencode($title) . '&url=' . urlencode($url . '?network=reddit');
				break;
			case 'google':
				return 'https://plus.google.com/share?url=' . urlencode($url . '?network=google');
				break;
			case 'link':
				return $url . '&network=link';
				break;
			case 'pinterest':
				return'http://pinterest.com/pin/create/button/?url=' . urlencode($url  . '?network=pinterest') . '&media=' . urlencode($image) . '&description=' . urlencode($title);
				break;
			case 'stumbleupon':
				return 'http://www.stumbleupon.com/submit?url=' . urlencode($url  . '?network=stumble') . '?title=' . urlencode($title);
				break;
			case 'tumblr':
				return 'http://www.tumblr.com/share/link?url=' . urlencode($url  . '?network=tumblr') . '&description=' . urlencode($description);
				break;
			default:
				return $url . '&network=link';
				break;
		endswitch;
	}
}