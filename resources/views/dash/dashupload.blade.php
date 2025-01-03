@extends('layouts.main')

@section('content')
    {{-- Header --}}
    @include('dash.dashnav')
    {{-- End of Header --}}

    <div class="dashboard-content-wrap">
        <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ms-3">
            <i class="la la-bars me-1"></i> Dashboard Nav
        </div>
        <div class="container-fluid">
            <div class="dashboard-heading mb-5">
                <h3 class="fs-22 font-weight-semi-bold">Submit Course</h3>
            </div>

            <div class="card-body">
                @if (session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: '{{ session('success') }}',
                            confirmButtonText: 'OK'
                        });
                    </script>
                @endif
            </div>


            <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card card-item">
                    <div class="card-body">
                        <h3 class="fs-22 font-weight-semi-bold pb-2">Basic Info</h3>
                        <div class="divider"><span></span></div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label-text">Course Title</label>
                                    <input class="form-control form--control ps-3" type="text" name="title" required
                                        placeholder="e.g. Learn Webdesign" />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label-text">Course Subtitle</label>
                                    <input class="form-control form--control ps-3" type="text" name="section" required
                                        placeholder="e.g. Empower yourself with this comprehensive Javascript course." />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label-text"> Course Price</label>
                                    <input class="form-control form--control ps-3" type="number" name="price" required
                                        placeholder="e.g. Input Course Price" />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label-text">Instructor's Name</label>
                                    <input class="form-control form--control ps-3" type="text" name="instructor_name"
                                        required value="{{ Auth::user()->fname }} {{ Auth::user()->lname }}" readonly />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label-text">Total Lectures</label>
                                    <input class="form-control form--control ps-3" type="number" name="class" required
                                        placeholder="Total Lectures" />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label-text">Course Hours</label>
                                    <input class="form-control form--control ps-3" type="number" name="course_time"
                                        required placeholder="e.g. 30" />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label-text"> Course Language</label>
                                    <div class="form-group text-center">
                                        <input type="text" id="selected-languages"
                                            class="form-control form--control ps-3"
                                            value="{{ old('courselanguage') ? implode(', ', old('courselanguage')) : '' }}"
                                            name="courselanguage[]" placeholder="e.g. English" data-role="tagsinput"
                                            autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group select2-full-wrapper dropdown-arrow">
                                    <label class="label-text">Level</label>
                                    <select class="form-control form--control ps-3 text-black" id="level" name="level"
                                        required>
                                        <option value="" disabled selected>Select Level</option>
                                        <option value="All Levels">All Levels</option>
                                        <option value="Beginner">Beginner</option>
                                        <option value="Intermediate">Intermediate</option>
                                        <option value="Expert">Expert</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group select2-full-wrapper dropdown-arrow">
                                    <label class="label-text">Course Category</label>
                                    <div class="select-container w-auto">
                                        <select id="category" class="form-control form--control ps-3 text-black"
                                            name="category" required aria-label="Course Category">
                                            <option value="" disabled selected>Select a course image category</option>
                                            <option value="graphic-design" id="category-graphic-design">Graphic Design
                                            </option>
                                            <option value="computer-programming-&-software-development"
                                                id="category-computer-programming-&-software-development">Computer
                                                Programming and Software Development
                                            </option>
                                            <option value="ui/ux" id="category-ui/ux">UI/UX</option>
                                            <option value="data-analysis" id="category-data-analysis">Data Analysis &
                                                Accounting</option>
                                            <option value="itsuppport-&-troubleshooting"
                                                id="category-itsupport-&-troubleshooting">IT Support & Troubleshooting
                                            </option>
                                            <option value="webdesign-&-development" id="category-webdesign-&-development">
                                                Web Design & Development</option>
                                            <option value="game-design" id="category-game-design">Game Design</option>
                                            <option value="digital-illustration" id="category-digital-illustration">
                                                Digital
                                                Illustratioin</option>
                                            <option value="character-animation" id="category-character-animation">
                                                Character
                                                Animation</option>
                                            <option value="cloud-computing" id="category-cloud-computing">Cloud Computing
                                            </option>
                                            <option value="3d-modeling" id="category-3d-modeling">3D Modeling</option>
                                            <option value="other" id="category-other">Other</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Additional form for "Other" category -->
                                <div id="other-category-form" style="display: none; margin-top: 15px;">
                                    <label for="other-category-image">Upload Course Thumbnail or Image</label>
                                    <input type="file" id="other-category-image" class="form-control"
                                        name="other_category_image" accept="image/*">
                                </div>
                            </div>

                            <!-- Image Viewer Section -->
                            <div class="col-lg-6">
                                <div id="image-viewer-container">
                                    <img id="default-image" src="" alt="Default"
                                        style="max-width: 100%; height: auto; border: 2px solid #ddd; border-radius: 5px; padding: 5px;">
                                </div>
                                <div id="image-placeholder" style="margin-top: 15px;">
                                    <p>No image selected</p>
                                </div>

                                <!-- Hidden Input for Default Image Path -->
                                <input type="hidden" id="default-image-path" name="default_image">
                            </div>

                            {{-- Resource --}}
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="label-text">Course Resources (Optional)</label>

                                    <!-- Loop for Multiple Lecture and Resource Titles -->
                                    <div id="resource-section">
                                        <div class="lecture-item" id="lecture-item-0">
                                            <div class="form-group">
                                                <label class="label-text">Lecture Title</label>
                                                <input class="form-control form--control ps-3" type="text"
                                                    name="lectures[0][lecture_title]"
                                                    placeholder="e.g. Introduction to Web Design" required />
                                            </div>
                                            <div id="resources-0" class="resources-wrapper">
                                                <div class="resource-item" id="resource-item-0-0">
                                                    <div class="form-group">
                                                        <label class="label-text">Resource Title</label>
                                                        <input class="form-control form--control ps-3" type="text"
                                                            name="lectures[0][resources][0][title]"
                                                            placeholder="e.g. Course PDF, Study Materials" required />
                                                    </div>
                                                    <div class="file-upload-wrap">
                                                        <input type="file" name="lectures[0][resources][0][file]"
                                                            class="form-control ps-3" required>
                                                        <small class="form-text text-muted">Upload a resource file (PDF,
                                                            DOCX, etc.).</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Button to Add More Resources to This Lecture -->
                                            <div class="course-submit-btn-box pb-4">
                                                <button type="button" class="btn btn-secondary bg-6"
                                                    onclick="addResourceToLecture(0)">+ Add Another Resource</button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Button to Add More Lectures -->
                                    <div class="course-submit-btn-box pb-4" id="add-lecture-btn">
                                        <button type="button" class="btn btn-secondary bg-6"
                                            onclick="addLectureSection()">+ Add Another Lecture</button>
                                    </div>
                                </div>
                            </div>

                            <script>
                                // Function to Add New Lecture Section
                                function addLectureSection() {
                                    var resourceSection = document.getElementById('resource-section');
                                    var newLectureIndex = resourceSection.getElementsByClassName('lecture-item').length;
                                    var newLectureItem = document.createElement('div');
                                    newLectureItem.classList.add('lecture-item');
                                    newLectureItem.id = 'lecture-item-' + newLectureIndex;

                                    newLectureItem.innerHTML = `
                                        <div class="form-group">
                                            <label class="label-text">Lecture Title</label>
                                            <input class="form-control form--control ps-3" type="text" name="lectures[${newLectureIndex}][lecture_title]" placeholder="e.g. Introduction to Web Design" required />
                                        </div>
                                        <div id="resources-${newLectureIndex}" class="resources-wrapper">
                                            <div class="resource-item" id="resource-item-${newLectureIndex}-0">
                                                <div class="form-group">
                                                    <label class="label-text">Resource Title</label>
                                                    <input class="form-control form--control ps-3" type="text" name="lectures[${newLectureIndex}][resources][0][title]" placeholder="e.g. Course PDF, Study Materials" required />
                                                </div>
                                                <div class="file-upload-wrap">
                                                    <input type="file" name="lectures[${newLectureIndex}][resources][0][file]" class="form-control ps-3" required>
                                                    <small class="form-text text-muted">Upload a resource file (PDF, DOCX, etc.).</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="course-submit-btn-box pb-4">
                                            <button type="button" class="btn btn-secondary bg-6" onclick="addResourceToLecture(${newLectureIndex})">+ Add Another Resource</button>
                                        </div>
                                    `;

                                    resourceSection.appendChild(newLectureItem);
                                }

                                // Function to Add New Resource to an Existing Lecture
                                function addResourceToLecture(lectureIndex) {
                                    var resourceWrapper = document.getElementById(`resources-${lectureIndex}`);
                                    var newResourceIndex = resourceWrapper.getElementsByClassName('resource-item').length;
                                    var newResourceItem = document.createElement('div');
                                    newResourceItem.classList.add('resource-item');
                                    newResourceItem.id = `resource-item-${lectureIndex}-${newResourceIndex}`;

                                    newResourceItem.innerHTML = `
                                        <div class="form-group">
                                            <label class="label-text">Resource Title</label>
                                            <input class="form-control form--control ps-3" type="text" name="lectures[${lectureIndex}][resources][${newResourceIndex}][title]" placeholder="e.g. Course PDF, Study Materials" required />
                                        </div>
                                        <div class="file-upload-wrap">
                                            <input type="file" name="lectures[${lectureIndex}][resources][${newResourceIndex}][file]" class="form-control ps-3" required>
                                            <small class="form-text text-muted">Upload a resource file (PDF, DOCX, etc.).</small>
                                        </div>
                                    `;

                                    resourceWrapper.appendChild(newResourceItem);
                                }
                            </script>
                            {{-- End of Resource --}}

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="label-text mb-0">Requirements</label>
                                    <span class=" ms-3" style="font-size: 0.875rem; font-style: italic; color: red;">
                                        *Please select bullet list before you input your requirements.
                                    </span>
                                    <textarea class="form-control form--control user-text-editor ps-3" name="requirement">{{ old('requirement') }}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="label-text">Course Description</label>
                                    <textarea class="form-control form--control text-editor ps-2" name="description">{{ old('description') }}</textarea>
                                </div>
                            </div>

                            {{-- <div class="col-lg-12">
                                <div class="form-group mb-0">
                                    <label class="label-text">Course Picture</label>
                                    <div class="file-upload-wrap">
                                        <input type="hidden" name="image_path" value="default-image.png">
                                        <!-- Image Viewer (instead of file upload input) -->
                                        <div id="image-viewer-container" style="display: none;">
                                            <img id="default-image" src="" alt="Course Category Image"
                                                style="width: 600px; height: 400px; object-fit: cover; margin-top: 10px;">
                                        </div>
                                        <div id="image-placeholder" style="display: block;">
                                            <span class="file-upload-text"><i class="la la-cloud-upload me-2 fs-18"></i>
                                                Select a category to see the default image.</span>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                @if (Auth::user()->verified)
                    <!-- Button for verified tutors -->
                    <div class="course-submit-btn-box pb-4" id="submitBtn">
                        <button class="btn theme-btn" type="submit">Submit Course</button>
                    </div>
                @else
                    <!-- Button for unverified tutors -->
                    <div class="course-submit-btn-box pb-4" id="verifyAlertBtn">
                        <button class="btn theme-btn" type="button"
                            onclick="swal('Verification Required', 'You need to verify your account before submitting a course.', 'warning')">Submit
                            Course</button>
                    </div>
                @endif
            </form>
        </div>
    </div>

    <!-- Include this script for tagsinput functionality -->
    <script>
        $(document).ready(function() {
            $('#selected-languages').tagsinput({
                trimValue: true,
                confirmKeys: [13, 32] // Allow Enter and Space to confirm input
            });
        });
    </script>

    <script>
        document.getElementById('category').addEventListener('change', function() {
            const category = this.value;
            let defaultImage = ''; // Variable to store the image path

            // Show/hide the upload form if "Other" is selected
            const otherCategoryForm = document.getElementById('other-category-form');
            if (category === 'other') {
                otherCategoryForm.style.display = 'block';
            } else {
                otherCategoryForm.style.display = 'none';
            }

            // Set default image based on the category selected
            switch (category) {
                case 'graphic-design':
                    defaultImage = '/storage/categories/graphicdesign-default.png';
                    break;
                case 'computer-programming-&-software-development':
                    defaultImage = '/storage/categories/computer-programming-&-software-development.png';
                    break;
                case 'ui/ux':
                    defaultImage = '/storage/categories/uiux-default.png';
                    break;
                case 'data-analysis':
                    defaultImage = '/storage/categories/data-analysis-default.png';
                    break;
                case 'itsuppport-&-troubleshooting':
                    defaultImage = '/storage/categories/itsuppport-&-troubleshooting-default.png';
                    break;
                case 'webdesign-&-development':
                    defaultImage = '/storage/categories/webdesign-&-development-default.png';
                    break;
                case 'game-design':
                    defaultImage = '/storage/categories/game-design-default.png';
                    break;
                case 'digital-illustration':
                    defaultImage = '/storage/categories/digital-illustration-default.png';
                    break;
                case 'character-animation':
                    defaultImage = '/storage/categories/character-animation-default.png';
                    break;
                case 'cloud-computing':
                    defaultImage = '/storage/categories/cloud-computing-default.png';
                    break;
                case '3d-modeling':
                    defaultImage = '/storage/categories/3d-modeling-default.png';
                    break;
                default:
                    defaultImage = ''; // No default if category is not selected
            }

            // Update the default image and make it visible
            const imageViewer = document.getElementById('image-viewer-container');
            const imagePlaceholder = document.getElementById('image-placeholder');
            const defaultImageElement = document.getElementById('default-image');
            const hiddenInput = document.getElementById('default-image-path');

            if (defaultImage) {
                imageViewer.style.display = 'block';
                imagePlaceholder.style.display = 'none';
                defaultImageElement.src = defaultImage;
                hiddenInput.value = defaultImage; // Set hidden input value
            } else {
                imageViewer.style.display = 'none';
                imagePlaceholder.style.display = 'block';
                hiddenInput.value = ''; // Clear hidden input value
            }
        });

        // Handle "Other" category image upload
        document.getElementById('other-category-image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imageViewer = document.getElementById('image-viewer-container');
                    const imagePlaceholder = document.getElementById('image-placeholder');
                    const defaultImageElement = document.getElementById('default-image');
                    const hiddenInput = document.getElementById('default-image-path');

                    imageViewer.style.display = 'block';
                    imagePlaceholder.style.display = 'none';
                    defaultImageElement.src = e.target.result; // Show uploaded image
                    hiddenInput.value = file.name; // Set hidden input value with file name
                };
                reader.readAsDataURL(file);
            }
        });

        // Trigger the change event on page load to set the default image for any pre-selected category
        document.getElementById('category').dispatchEvent(new Event('change'));

        // Submit the form and include the uploaded image
        document.getElementById('course-form').addEventListener('submit', function(event) {
            const category = document.getElementById('category').value;
            const otherImageFile = document.getElementById('other-category-image').files[0];
            const hiddenInput = document.getElementById('default-image-path');

            // If "Other" category is selected and an image is uploaded, set the hidden input value to the uploaded image name
            if (category === 'other' && otherImageFile) {
                hiddenInput.value = otherImageFile.name; // Set the filename to the hidden input
            }

            // If no "Other" image uploaded, set the hidden input value to the default image path (if any)
            if (!otherImageFile && category !== 'other') {
                hiddenInput.value = document.getElementById('default-image')
                    .src; // Use default image if category is not "Other"
            }

            // The hidden input 'default-image-path' will now carry the proper image path or uploaded file name.
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const verifyAlertBtn = document.getElementById('verifyAlertBtn');

            if (verifyAlertBtn) {
                verifyAlertBtn.addEventListener('click', function() {
                    // Trigger SweetAlert
                    Swal.fire({
                        icon: 'warning',
                        title: 'Verification Required',
                        text: 'You need to verify your account before you can upload course.',
                        confirmButtonText: 'Go to Settings'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirect to settings page
                            window.location.href = "{{ route('tutor.setting') }}";
                        }
                    });
                });
            }
        });
    </script>
@endsection
