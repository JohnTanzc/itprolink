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
                    <div id="success-message" class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
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
                                    <label class="label-text">Course Benefits</label>
                                    <input class="form-control form--control ps-3" type="text" name="section" required
                                        placeholder="e.g. Design your own website" />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label-text">Price</label>
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
                                <div class="form-group select2-full-wrapper dropdown-arrow">
                                    <label class="label-text">Course Category</label>
                                    <div class="select-container w-auto">
                                        <select id="category" class="form-control form--control ps-3 text-black"
                                            name="category" required aria-label="Course Category">
                                            <option value="" disabled selected>Select a course category</option>
                                            <option value="graphic-design" id="category-graphic-designt">Graphic Design
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
                                            <option value="digital-illustration" id="category-digital-illustration">Digital
                                                Illustratioin</option>
                                            <option value="character-animation" id="category-character-animation">Character
                                                Animation</option>
                                            <option value="cloud-computing" id="category-cloud-computing">Cloud Computing
                                            </option>
                                            <option value="3d-modeling" id="category-3d-modeling">3D Modeling</option>
                                            <option value="other" id="category-other">Other</option>
                                        </select>
                                    </div>
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
                                    <label class="label-text">Course Duration</label>
                                    <input class="form-control form--control ps-3" type="number" name="course_time"
                                        required placeholder="e.g. Enter Duration" />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label-text">Language (Select all that apply)</label>
                                    <div class="form-group text-center">
                                        <input type="text" id="selected-languages"
                                            class="form-control form--control ps-3"
                                            value="{{ old('courselanguage') ? implode(', ', old('courselanguage')) : '' }}"
                                            name="courselanguage[]" placeholder="Type languages and press Enter"
                                            data-role="tagsinput" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group select2-full-wrapper dropdown-arrow">
                                    <label class="label-text">Level</label>
                                    <select class="form-control form--control ps-3 text-black" id="level"
                                        name="level" required>
                                        <option value="" disabled selected>Select Level</option>
                                        <option value="All Levels">All Levels</option>
                                        <option value="Beginner">Beginner</option>
                                        <option value="Intermediate">Intermediate</option>
                                        <option value="Expert">Expert</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Resource --}}
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="label-text">Course Resources (Optional)</label>

                                    <!-- Loop for Multiple Lecture and Resource Titles -->
                                    <div id="resource-section">
                                        <div class="resource-item">
                                            <div class="form-group">
                                                <label class="label-text">Lecture Title</label>
                                                <input class="form-control form--control ps-3" type="text" name="lectures[0][lecture_title]" placeholder="e.g. Introduction to Web Design" required />
                                            </div>
                                            <div class="form-group">
                                                <label class="label-text">Resource Title</label>
                                                <input class="form-control form--control ps-3" type="text" name="lectures[0][resources][0][title]" placeholder="e.g. Course PDF, Study Materials" required />
                                            </div>
                                            <div class="file-upload-wrap">
                                                <input type="file" name="lectures[0][resources][0][file]" class="form-control ps-3" multiple required>
                                                <small class="form-text text-muted">You can upload multiple resource files (PDF, DOCX, etc.) for this lecture.</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Button to Add More Resources -->
                                    <div class="course-submit-btn-box pb-4" id="add-resource-btn">
                                        <button type="button" class="btn btn-secondary bg-6" onclick="addResourceSection()">+ Add Another Resource</button>
                                    </div>
                                </div>
                            </div>

                            <script>
                                // Function to Add New Resource Section
                                function addResourceSection() {
                                    var resourceSection = document.getElementById('resource-section');
                                    var newResourceItem = document.createElement('div');
                                    newResourceItem.classList.add('resource-item');

                                    newResourceItem.innerHTML = `
                                        <div class="form-group">
                                            <label class="label-text">Lecture Title</label>
                                            <input class="form-control form--control ps-3" type="text" name="lecture_title[]" placeholder="e.g. Introduction to Web Design" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="label-text">Resource Title</label>
                                            <input class="form-control form--control ps-3" type="text" name="resource_title[]" placeholder="e.g. Course PDF, Study Materials" required />
                                        </div>
                                        <div class="file-upload-wrap">
                                            <input type="file" name="resources[]" class="form-control ps-3" multiple required>
                                            <small class="form-text text-muted">You can upload multiple resource files (PDF, DOCX, etc.) for this lecture.</small>
                                        </div>
                                    `;

                                    resourceSection.appendChild(newResourceItem);
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

                            <div class="col-lg-12">
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
                            </div>
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
        $(document).ready(function () {
            $('#selected-languages').tagsinput({
                trimValue: true,
                confirmKeys: [13, 32]  // Allow Enter and Space to confirm input
            });
        });
    </script>

    <script>
        document.getElementById('category').addEventListener('change', function() {
            const category = this.value;
            let defaultImage = ''; // Variable to store the image path


            // Set default image based on the category selected
            switch (category) {
                case 'graphic-design':
                    defaultImage = '/storage/categories/graphicdesign-default.png';
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
                case 'other':
                    defaultImage = '/storage/categories/other-default.png';
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

        // Trigger the change event on page load to set the default image for any pre-selected category
        document.getElementById('category').dispatchEvent(new Event('change'));
    </script>
    {{-- <script src="https://cdn.tiny.cloud/1/l5num6gjn56iw78en3nuw0kie4ol1afq31ocsjfy04yziuw5/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script> --}}

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
