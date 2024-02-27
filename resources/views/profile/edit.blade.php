@extends('layouts.master')
@section('title')
    @lang('translation.settings')
@endsection
@section('content')
    <div class="row">
        <div class="col-xxl-3">
            <div class="card">
                <div class="card-body p-4">
                    <div class="text-center">
                        <h5 class="fs-16 mb-1">{{ $user->name }}</h5>
                        <p class="text-muted mb-0">
                            <span>Roles:</span>
                            @foreach ($roles as $role)
                            @if ($user->hasAnyRole($role->id) ? : false)                                 
                                <span class="badge bg-primary">{{ $role->name }}</span>
                            @endif
                            @endforeach</p>
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
        <div class="col-xxl-9">
            <div class="card">
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                            <form action="javascript:void(0);">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="firstnameInput" class="form-label">First
                                                Name</label>
                                            <input type="text" class="form-control" id="firstnameInput"
                                                placeholder="Enter your firstname" value="Dave">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="lastnameInput" class="form-label">Last
                                                Name</label>
                                            <input type="text" class="form-control" id="lastnameInput"
                                                placeholder="Enter your lastname" value="Adame">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="phonenumberInput" class="form-label">Phone
                                                Number</label>
                                            <input type="text" class="form-control" id="phonenumberInput"
                                                placeholder="Enter your phone number" value="+(1) 987 6543">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">Email
                                                Address</label>
                                            <input type="email" class="form-control" id="emailInput"
                                                placeholder="Enter your email" value="daveadame@velzon.com">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="JoiningdatInput" class="form-label">Joining
                                                Date</label>
                                            <input type="text" class="form-control" data-provider="flatpickr"
                                                id="JoiningdatInput" data-date-format="d M, Y"
                                                data-deafult-date="24 Nov, 2021" placeholder="Select date" />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="skillsInput" class="form-label">Skills</label>
                                            <select class="form-control" name="skillsInput" data-choices
                                                data-choices-removeItem multiple id="skillsInput">
                                                <option value="illustrator">Illustrator</option>
                                                <option value="photoshop">Photoshop</option>
                                                <option value="css">CSS</option>
                                                <option value="html">HTML</option>
                                                <option value="javascript" selected>Javascript</option>
                                                <option value="python">Python</option>
                                                <option value="php">PHP</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="designationInput" class="form-label">Designation</label>
                                            <input type="text" class="form-control" id="designationInput"
                                                placeholder="Designation" value="Lead Designer / Developer">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="websiteInput1" class="form-label">Website</label>
                                            <input type="text" class="form-control" id="websiteInput1"
                                                placeholder="www.example.com" value="www.velzon.com" />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="cityInput" class="form-label">City</label>
                                            <input type="text" class="form-control" id="cityInput" placeholder="City"
                                                value="California" />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="countryInput" class="form-label">Country</label>
                                            <input type="text" class="form-control" id="countryInput"
                                                placeholder="Country" value="United States" />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="zipcodeInput" class="form-label">Zip
                                                Code</label>
                                            <input type="text" class="form-control" minlength="5" maxlength="6"
                                                id="zipcodeInput" placeholder="Enter zipcode" value="90011">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="mb-3 pb-2">
                                            <label for="exampleFormControlTextarea"
                                                class="form-label">Description</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea" placeholder="Enter your description"
                                                rows="3">Hi I'm Anna Adame,It will be as simple as Occidental; in fact, it will be Occidental. To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is European languages are members of the same family.</textarea>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-primary">Updates</button>
                                            <button type="button" class="btn btn-soft-success">Cancel</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <!--end tab-pane-->
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
@endsection
@section('script')
    <script src="{{ URL::asset('build/js/pages/profile-setting.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
