// JavaScript Document
 
  $(document).ready(function(){
  	"use strict";
    $('[title]').tooltip();
	 if( $( window ).width() >= "768" ) {
		$(".header").sticky({topSpacing:0});	
    }

  });
  