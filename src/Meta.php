<?php namespace Lean\Utils;

/**
 * A suite of functions for working with a page's metadata.
 * Uses data entered via the Yoast SEO plugin's UI by default, with a suitable fallback.
 *
 * Class Meta.
 *
 * @package Lean\Utils
 */
class Meta
{
	/**
	 * Get all metadata for a post.
	 *
	 * @param \WP_Post $post The post.
	 * @return array
	 */
	public static function get_all_post_meta( $post ) {
		return [
			'title' => self::get_post_meta_title( $post ),
			'description' => '',
			'og' => [
				'title' => self::get_post_meta_title( $post ),
				'description' => '',
			],
			'twitter' => [
				'title' => '',
			],
		];
	}

	/**
	 * Get the post's meta title
	 *
	 * @param \WP_Post $post The post.
	 * @return string
	 */
	public static function get_post_meta_title( $post ) {
		$title = get_post_meta( $post->ID, '_yoast_wpseo_title', true );

		if ( empty( $title ) ) {
			$title = $post->post_title;
		}

		return $title;
	}
}
