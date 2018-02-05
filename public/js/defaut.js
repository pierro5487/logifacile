/***
 *
 * @param etat
 * @param message
 * affichage page loader
 */
function setAjaxLoaderFullPage(etat,message){
	if(typeof(message) == 'undefined'){
		message = '';
	}else if(message != ''){
		message += '...';
	}
	ajaxLoaderFullPage = $('#ajax-loader-full-page');
	ajaxLoaderFullPage.find('.loaderTexte').html(message);
	if(etat){
		ajaxLoaderFullPage.removeClass('hide');
	}else{
		ajaxLoaderFullPage.addClass('hide')
	}
}