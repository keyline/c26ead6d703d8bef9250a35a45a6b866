<?php
use App\Models\User;
use App\Models\UserDocument;
use App\Models\RequireDocument;
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
<style type="text/css">
    .choices__list--multiple .choices__item {
        background-color: #f9233f;
        border: 1px solid #f9233f;
    }
</style>
<div class="account_wrapper">
    <?= $sidebar ?>
    <div class="wrapper account_inner_section d-flex flex-column min-vh-100 bg-light">
        <header class="header header-sticky mb-4">
            <div class="container-fluid">
                <button class="header-toggler px-md-0 me-md-3 d-md-none" type="button"
                    onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <h4 class="pagestitle-item mb-0"><?= $page_header ?></h4>
                <ul class="header-nav ms-auto"></ul>
            </div>
        </header>
        <div class="col-xl-12">
            @if (session('success_message'))
                <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show autohide"
                    role="alert">
                    {{ session('success_message') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @endif
            @if (session('error_message'))
                <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show autohide"
                    role="alert">
                    {{ session('error_message') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @endif
        </div>
        <div class="body flex-grow-1 px-3">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                        <div class="card mb-4 text-white bg-whitebg">
                            <div class="card-body profile_cardbody">
                                <form method="POST" action="" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="mode10" value="updateData">
                                    <input type="hidden" name="user_id" value="<?= $profileDetail->id ?>">
                                    <div class="profile_myaccount">
                                        <div class="profile_changeavtar">
                                            <div class="profil_avimg">
                                                <div class="profl_img_show">
                                                    <!-- <img src="<?= env('FRONT_DASHBOARD_ASSETS_URL') ?>assets/img/avatars/1.jpg" alt="img"> -->
                                                    <!-- <img src="<?= env('NO_IMAGE') ?>" alt="<?= $profileDetail->profile_pic ?>"  id="img_url" class="img-thumbnail" style="height: 110px; margin-top: 10px;"> -->
                                                    <?php if($profileDetail->profile_pic != ''){?>
                                                    <img src="<?= env('UPLOADS_URL') . 'user/' . $profileDetail->profile_pic ?>"
                                                        id="img_url" class="img-thumbnail"
                                                        alt="<?= $profileDetail->profile_pic ?>"
                                                        style="width: 150px; height: 150px; margin-top: 10px;">
                                                    <?php } else {?>
                                                    <img src="<?= env('NO_IMAGE') ?>"
                                                        alt="<?= $profileDetail->profile_pic ?>" id="img_url"
                                                        class="img-thumbnail"
                                                        style="width: 150px; height: 150px; margin-top: 10px;">
                                                    <?php }?>
                                                </div>
                                                <div class="profl_imgrequi">
                                                    <strong>Profile Image (working)</strong>
                                                </div>
                                            </div>
                                            <div class="prfile_chagebtn" style="margin-top:10px">
                                                <input type="file" class="form-control" name="image" id="img_file"
                                                    onChange="img_pathUrl(this);"
                                                    accept="image/png, image/gif, image/jpeg">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="col-md-12 profi_stumentlink">
                                                <div class="profi_copylink">
                                                    <label for="basic-url" class="form-label">Your Stumento page
                                                        link</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"
                                                            id="basic-addon3">stumento.com/</span>
                                                        <input type="text" class="form-control" name="display_name"
                                                            value="<?= $profileDetail->display_name ? $profileDetail->display_name : '' ?>"
                                                            id="myInput" aria-describedby="basic-addon3 basic-addon4">
                                                    </div>
                                                </div>
                                                <div class="profi_copybtn">
                                                    <a href="#" onclick="myFunction()"><i
                                                            class="fa-regular fa-copy"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="formGroupExampleInput" class="form-label">First Name</label>
                                                <input type="text" class="form-control" placeholder="First name"
                                                    name="fname" aria-label="First name"
                                                    value="<?= $profileDetail->first_name ? $profileDetail->first_name : '' ?>"
                                                    required>
                                                @error('fname')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="formGroupExampleInput" class="form-label">Last
                                                    Name</label>
                                                <input type="text" class="form-control" placeholder="Last name"
                                                    name="lname" aria-label="Last name"
                                                    value="<?= $profileDetail->last_name ? $profileDetail->last_name : '' ?>"
                                                    required>
                                                @error('lname')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label for="formGroupExampleInput" class="form-label">About
                                                    yourself</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="8" required><?= $profileDetail->about_yourself ? $profileDetail->about_yourself : '' ?></textarea>
                                                @error('description')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-12">
                                                <h3 style="font-size: 16px;">Social Links</h3>
                                                <div class="field_wrapper">
                                                    <?php
                                                    $social_platform = json_decode($profileDetail->social_platform);
                                                    $social_url = json_decode($profileDetail->social_url);
                                                    ?>
                                                    <?php if(!empty($social_platform)){ for($s=0;$s<count($social_platform);$s++) {?>
                                                    <div class="row" style="margin-top: 10px;">
                                                        <div class="col-md-4">
                                                            <select class="form-control" name="social_platform[]">
                                                                <option value="" selected>Social Platforms
                                                                </option>
                                                                <?php if($socialPlatforms){ foreach($socialPlatforms as $socialPlatform){?>
                                                                <option value="<?= $socialPlatform->name ?>"
                                                                    <?= $social_platform[$s] == $socialPlatform->name ? 'selected' : '' ?>>
                                                                    <?= $socialPlatform->name ?></option>
                                                                <?php } }?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control"
                                                                name="social_url[]" value="<?= $social_url[$s] ?>"
                                                                placeholder="Social Link">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <a href="javascript:void(0);" class="remove_button"
                                                                title="Add field">
                                                                <i class="fa fa-minus-circle fa-2x text-danger"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <?php } }?>
                                                    <div class="row" style="margin-top: 10px;">
                                                        <div class="col-md-4">
                                                            <select class="form-control" name="social_platform[]">
                                                                <option value="" selected>Social Platforms
                                                                </option>
                                                                <?php if($socialPlatforms){ foreach($socialPlatforms as $socialPlatform){?>
                                                                <option value="<?= $socialPlatform->name ?>">
                                                                    <?= $socialPlatform->name ?></option>
                                                                <?php } }?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control"
                                                                name="social_url[]" placeholder="Social Link">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <a href="javascript:void(0);" class="add_button"
                                                                title="Add field">
                                                                <i class="fa fa-plus-circle fa-2x text-success"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label for="city" class="form-label">City</label>
                                                <input type="text" class="form-control" placeholder="City"
                                                    name="city" aria-label="City"
                                                    value="<?= $profileDetail->city ? $profileDetail->city : '' ?>"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="city" class="form-label">Document Type</label>
                                                    <?php
                                                    $studentDocument = UserDocument::where('user_id', '=', $user_id)
                                                        ->where('type', '=', 'STUDENT')
                                                        ->first();

                                                    if ($studentDocument) {
                                                        $doucument_id = $studentDocument->doucument_id;
                                                        $documentFile = $studentDocument->document;
                                                    } else {
                                                        $doucument_id = '';
                                                        $documentFile = '';
                                                    }
                                                    ?>
                                                    <select class="form-control" name="doc_type" id="doc_type">
                                                        <option value="" selected>Select Document</option>
                                                        <?php if($documents){ foreach($documents as $document){?>
                                                        <option value="<?= $document->id ?>"
                                                            <?= $document->id == $doucument_id ? 'selected' : '' ?>>
                                                            <?= $document->document ?></option>
                                                        <?php } }?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="city" class="form-label">Document File</label>
                                                    <input type="file" class="form-control" name="user_doc"
                                                        id="fileName" placeholder="Confirm password"
                                                        data-check="Upload Document"
                                                        accept="image/png, image/gif, image/jpeg, application/pdf"
                                                        onchange="validateFileType(this)">
                                                    <span class="text-primary">Only jpg, jpeg, png & pdf files & less
                                                        than 2 MB files are allowed</span>
                                                    <?php if($documentFile != ''){?>
                                                    <a href="<?= env('UPLOADS_URL') . 'user/' . $documentFile ?>"
                                                        target="_blank" class="badge bg-info"
                                                        style="text-decoration: none;">View Document</a>
                                                    <?php }?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <button type="submit" class="myprof_btn">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="card mb-4 text-white bg-whitebg">
                            <div class="card-body ">
                                <div class="title_myaccount">
                                    <h3>Your details</h3>
                                    <?php $getUserID = User::where('id', '=', $profileDetail->user_id)->first(); ?>
                                    <div class="prfile_editor">
                                        <div class="profle_topedit">
                                            <label class="form-label"><i class="fa fa-envelope"></i></label>
                                            <label
                                                class="form-label"><?= $getUserID->email ? $getUserID->email : '' ?></label>
                                            <a href="#" class="edit-link">Edit</a>
                                            <a href="#" class="cancel">Cancel</a>
                                            <form method="POST" action="" enctype="multipart/form-data"
                                                class="editForm" style="display: none;">
                                                @csrf
                                                <input type="hidden" name="mode0" value="updateEmail">
                                                <input type="hidden" name="student_id"
                                                    value="<?= $profileDetail->id ?>">
                                                <input type="email" class="form-control" name="email"
                                                    id="email" placeholder="name@example.com"
                                                    value="<?= $getUserID->email ? $getUserID->email : '' ?>">
                                                @error('email')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                                                <input type="submit" value="Save"></input>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="prfile_editor">
                                        <div class="profle_topedit">
                                            <label class="form-label"><i class="fa fa-mobile"></i></label>
                                            <label
                                                class="form-label"><?= $getUserID->phone ? $getUserID->phone : '' ?></label>
                                            <a href="#" class="edit-link">Edit</a>
                                            <a href="#" class="cancel">Cancel</a>
                                            <form method="POST" action="" enctype="multipart/form-data"
                                                class="editForm" style="display: none;">
                                                @csrf
                                                <input type="hidden" name="mode1" value="updateMobile">
                                                <input type="hidden" name="student_id"
                                                    value="<?= $profileDetail->id ?>">
                                                <input type="tel" class="form-control" name="mobile"
                                                    id="mobile" placeholder="+91 9876543210"
                                                    value="<?= $getUserID->phone ? $getUserID->phone : '' ?>">
                                                @error('mobile')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                                                <input type="submit" value="Save"></input>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="prfile_editor">
                                        <div class="profle_topedit">
                                            <label class="form-label"><i class="fa fa-key"></i></label>
                                            <label class="form-label">********</label>
                                            <a href="#" class="edit-link">Edit</a>
                                            <a href="#" class="cancel">Cancel</a>
                                            <form method="POST" action="" enctype="multipart/form-data"
                                                class="editForm" style="display: none;">
                                                @csrf
                                                <input type="hidden" name="mode2" value="updatePassword">
                                                <input type="hidden" name="student_id"
                                                    value="<?= $profileDetail->id ?>">
                                                <input type="password" class="form-control" name="password"
                                                    id="password" value="">
                                                <input type="submit" value="Save"></input>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function myFunction() {
        var copyText = document.getElementById("myInput");
        copyText.select();
        let baseUrl = '<?= url('') ?>';
        copyText.setSelectionRange(0, 99999);
        let finalCopyValue = baseUrl + '/' + copyText.value;
        navigator.clipboard.writeText(finalCopyValue);
        alert("Copied the text: " + finalCopyValue);
    }

    function img_pathUrl(input) {
        $('#img_url')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var maxField = 10;
        var addButton = $('.add_button');
        var wrapper = $('.field_wrapper');
        var fieldHTML = '<div class="row" style="margin-top: 10px;">\
							<div class="col-md-4">\
								<select class="form-control" name="social_platform[]">\
									<option value="" selected>Social Platforms</option>\
									<?php if($socialPlatforms){ foreach($socialPlatforms as $socialPlatform){?> <
        option value = "<?= $socialPlatform->name ?>" > <?= $socialPlatform->name ?> < /option>\
        <?php } }?>
            <
            /select>\ < /
        div > \ <
            div class = "col-md-6" > \
            <
            input type = "text"
        class = "form-control"
        name = "social_url[]"
        placeholder = "Social Link" > \
            <
            /div>\ <
        div class = "col-md-2" > \
        <
        a href = "javascript:void(0);"
        class = "remove_button"
        title = "Add field" > \
            <
            i class = "fa fa-minus-circle fa-2x text-danger" > < /i>\ < /
        a > \ <
            /div>\ < /
        div > ';
        var x = 1;
        $(addButton).click(function() {
            if (x < maxField) {
                x++;
                $(wrapper).append(fieldHTML);
            }
        });
        $(wrapper).on('click', '.remove_button', function(e) {
            e.preventDefault();
            $(this).parent('div').parent('div').remove();
            x--;
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
            removeItemButton: true,
            maxItemCount: 30,
            searchResultLimit: 30,
            renderChoiceLimit: 30
        });
    });
</script>
