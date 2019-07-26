<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension {
	public function getFilters() {
		return [
			new TwigFilter( 'excerpt', [ $this, 'getExcerpt' ] ),
		];
	}

	public function getExcerpt( $content, $length = 40, $more = '...' ) {
		$excerpt = strip_tags( trim( $content ) );
		$words   = str_word_count( $excerpt, 2 );
		if ( count( $words ) > $length ) {
			$words = array_slice( $words, 0, $length, true );
			end( $words );
			$position = key( $words ) + strlen( current( $words ) );
			$excerpt  = substr( $excerpt, 0, $position ) . $more;
		}

		return $excerpt;
	}
}