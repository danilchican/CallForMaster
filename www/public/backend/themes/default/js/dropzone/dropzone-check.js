Dropzone.options.addImages = 
{
    maxFilesize: 1,
    acceptedFiles: 'image/*',
    success: function(file, response)
    {
    	if(file.status == 'success')
    		handleDropzoneFileUpload.handleSuccess(response);
    	else
    		handleDropzoneFileUpload.handleError(response);
    }
};

var handleDropzoneFileUpload = {
	handleError: function(response)
	{
		console.log(response);
	},
	handleSuccess: function(response)
	{
		var baseUrl = 'http://zm.local';
		var imageList = $('#album-images');
		var imageSrc = baseUrl + '/' + response.image_url;
		$(imageList).append('<li><div class="col-md-3 col-sm-3 col-xs-6 photos-box"><a data-lightbox="roadtrip href="' + imageSrc + '"><img style="width: 140px; height: 140px;" src="'+ imageSrc +'" /></a></div></li>')
	}
}