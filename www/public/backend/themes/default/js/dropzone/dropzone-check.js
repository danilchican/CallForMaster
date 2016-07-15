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
		var imageList = $('#album-images');
		var imageSrc = '/' + response.image_url;
		$(imageList).append('<li class="photo-item"><div class="col-md-3 col-sm-3 col-xs-6 photo-box"><i class="fa fa-times del-photo" photo-id="' + response.id + '"></i><a data-lightbox="roadtrip" href="' + imageSrc + '"><img style="width: 140px; height: 140px;" src="'+ imageSrc +'" /></a></div></li>')
	}
}