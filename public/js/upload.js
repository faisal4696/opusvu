Dropzone.options.fileUpload = {
    autoProcessQueue: false,
    url: '/file-upload',
    maxFilesize: 100000, // 10000MB
    method: 'POST',
    chunking: true,
    chunkSize: 1000000, // 1MB
    retryChunks: true,
    addRemoveLinks: true,
    init: function () {
        var myDropzone = this;

        // Update selector to match your button
        $("#submitBtn").click(function (e) {
            var name            = $('#name').val();
            if(name){
                e.preventDefault();
                myDropzone.processQueue();
            }
            else{
                alert('Name cannot be empty!');
            }
            e.preventDefault();
            if(isValid){
                myDropzone.processQueue();
            }
            else{
                alert('Please fill required fields');
            }

        });

        this.on('sending', function(file, xhr, formData) {
            // Append all form inputs to the formData Dropzone will POST
            var data = $('#fileUpload').serializeArray();
            $.each(data, function(key, el) {
                formData.append(el.name, el.value);
            });

            if(document.getElementById("thumb").files != null){
                formData.append("thumb",$('#thumb')[0].files[0]); // Added additional Image File.
            }else{
                console.log("files not selected");
            }
            if(document.getElementById("subtitle_eng").files != null){
                formData.append("subtitle_eng",$('#subtitle_eng')[0].files[0]); // Added additional Image File.
            }else{
                console.log("subtitle-eng files not selected");
            }
            if(document.getElementById("subtitle_spanish").files != null){
                formData.append("subtitle_spanish",$('#subtitle_spanish')[0].files[0]); // Added additional Image File.
            }else{
                console.log("subtitle-spanish files not selected");
            }
            if(document.getElementById("subtitle_french").files != null){
                formData.append("subtitle_french",$('#subtitle_french')[0].files[0]); // Added additional Image File.
            }else{
                console.log("subtitle-french files not selected");
            }
            console.log(formData);

        });

        this.on('uploadprogress', function(file, progress, bytesSent) {

            if(progress!=100){
                $('#uploaded').text(progress.toFixed(2));
                $('#file').val(progress.toFixed(2));
                var pc = progress.toFixed(2).toString();
                pc  = pc.toString() + '%';
                $(".progress-bar").css({
                    "width": pc,
                });
                $(".progress-bar").html(pc);
            }
        });

        this.on('success', function(file, response) {
            // $('#fileName').val(file.name);
            // $('#fileType').val(file.type);
            $('#uploaded').text('Completed 100');
            $('#file').val(100);
            $(".progress-bar").css({"width": '100%'});
            alert('uploading successfully completed!');
            if(confirm("uploading successfully completed!"))
            {
                history.go(-1);
            }
            location.reload();
        });

        this.on('complete', function(file) {
            console.log('completed');
            window.location = uploadCallBack;
        });

        this.on('error', function(file, error) {
            console.log(error);
        });

        this.on('canceled', function(file) {
            console.log('canceled');
        });
    }
}

function isValid() {
    var isValid = true;
    $('input').filter('[required]:visible').each(function() {
        if ( $(this).val() === '' )
        isValid = false;
    });
    return isValid;
}

