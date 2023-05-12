/*学生情報を取得する*/
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

/*授業に関連する学生情報と科目情報を取得する*/
$(document).on('change',".onchange-class",function () {

	var class_id = $(this).val();

	$.ajax({
		dataType: 'json',
		type: 'POST',
		url: "../../admin/result/getstudent",
		data: {'class_id':class_id},
		success: function(resp) {
			let subTag = "";
			$("#student_id").empty();
			$("#placeSubject").empty();
			if (class_id != "" && resp.stuNameList.length == '0') {
				alert("該当する授業に学生の結果がもう登録されました。");
				return false;
			}

			if (class_id != "" && resp.subDetails.length == '0') {
				alert("該当する授業に科目が登録されませんでした。");
				return false;
			}

			// 学生名一覧情報をリストボックスにセットする
			$.each(resp.stuNameList, function(index, value) {
			   $("#student_id").append("<option value="+index+">"+value+"</option>");
			});

			
			// 科目名を各INPUTでセットする
			$.each(resp.subDetails, function(index, value) {
				subTag += "<div class='form-group row'>";
				subTag += "<label class='col-md-4 col-form-label text-md-right'>"+value.subject_name+"</label><span class='text-danger'>*</span>";
				subTag += "<div class='col-md-6'><input name='marks["+value.id+"]' id='marks' type='number' min='0' max='100' class='form-control col-md-8 @error('marks') is-invalid @enderror placeholder='Enter the Marks out of 100' required maxlength='3' value=''>";
				// subTag += " @error('marks') ";
                // subTag += " <span class='invalid-feedback' role='alert'><strong>{{ $message }}</strong></span> ";
                // subTag += " @enderror ";
                subTag += "</div>";
                subTag += "</div>";
			});

			$("#placeSubject").html(subTag);
			// alert(JSON.stringify(resp.subDetails));
		},
		error: function(data,text) {
			alert(data.status);
			alert('there was a problem checking the fields');
		}
	});

	// var optVal= $(".onchange-class option:selected").val();
});

/*学生の結果を存在チェックする*/
$(document).on('change',".onchange-student",function () {

	var class_id = $('#class_id').val();
	var student_id = $(this).val();

	$.ajax({
		dataType: 'json',
		type: 'POST',
		url: "../../admin/result/chkStuResult",
		data: {'class_id':class_id, 'student_id':student_id},
		success: function(resp) {
			if (resp.stuResultInfo.length > '0') {
				alert("Selected Student Result is Already Declared");
			}
		},
		error: function(data,text) {
			alert(data.status);
			alert('there was a problem checking the fields');
		}
	});
});