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
			'description' => self::get_post_meta_description( $post ),
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
	 * Get the post's meta title.
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

	/**
	 * Get the post's meta description.
	 *
	 * @param \WP_Post $post The post.
	 * @return string
	 */
	public static function get_post_meta_description( $post ) {
		$description = get_post_meta( $post->ID, '_yoast_wpseo_metadesc', true );

		if ( empty( $description ) ) {
			$description = self::get_trimmed_meta_description( $post->post_content );
		}
		return $description;
	}

	/**
	 * Get text trimmed for a meta description.
	 *
	 * @param string $text The text to trim.
	 * @return string
	 */
	public static function get_trimmed_meta_description( $text ) {
		$limit = 160;

		if ( strlen( $text ) <= $limit ) {
			return $text;
		}

		$wrapped_text = explode( '\n', wordwrap( $text , $limit, '\n' ) );

		return $wrapped_text[0];
	}
}
