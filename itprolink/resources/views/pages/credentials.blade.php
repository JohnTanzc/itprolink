<div class="container">
    <div class="row justify-content-center">
        @foreach ($credentials as $data)
            <div class="col-12 col-md-4 mb-3 d-flex justify-content-center"> <!-- Centered on all screen sizes -->
                <div class="card" style="width: 14rem; margin-right: 10px;">
                    <img class="card-img-top"
                         src="{{ asset('storage/' . ($data->image_path ?? 'default-upload.png')) }}"
                         alt="Credential image"
                         style="width: 210px; height: 190px;">
                    <div class="card-body">
                        <p class="card-text">Some quick example </p>

                        <!-- Image Upload Form -->
                        <form action="{{ route('credentials.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="credential_image"
                                   style="display: block; width: 100%; margin-top: 5px;" accept="image/*">
                            <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
