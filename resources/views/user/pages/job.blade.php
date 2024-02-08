@extends('user.layout.app')
@section('style')
@endsection
@section('data_layout')

    <div class="modal fade job-status-modal" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="changeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('user.job.statusChange') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="quote_id" id="quote_id_for_status_change">
                        <div class="change-main-div">
                            <div class="change-title-div">Change Status</div>
                            <div class="change-to">
                                <label for="">Change to</label>
                                <select class="form-select status-types" id="status_change_to" name="status"
                                    aria-label="Default select example">
                                    <option value="Work Started">Work Started</option>
                                    <option value="Inspection Done">Inspection Done</option>
                                    <option value="Engine Ready">Engine Ready</option>
                                    <option value="Deposit Pending">Deposit Pending</option>
                                    <option value="Deposit Received">Deposit Received</option>
                                    <option value="Reached Garage">Reached Garage</option>
                                    <option value="Ready for Collection">Ready for Collection</option>
                                    <option value="Job Completed">Job Completed</option>
                                </select>
                            </div>
                            <div class="select-image-file">
                                <label for="">Select Image</label>
                                <input type="file" name="image" id="status_image" />

                            </div>

                            <div class="description">
                                <label for="">Add description</label>
                                <div class="form-floating">
                                    <textarea class="form-control" name="comments" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                                    <label class="floatingClass" for="floatingTextarea">Comments</label>
                                </div>
                            </div>
                            <div class="send-btn">
                                <button type="submit" class="btn send">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="noteModal" tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content quote-modal-content">
                <div class="modal-body">
                    <div class="modal-cross btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span>
                            <i class="fa-solid fa-xmark modal-cancle-btn"></i>
                        </span>
                    </div>
                    <div class="modal-content-div">
                        <div class="modal-content-top-div">
                            <div class="">

                            </div>
                            <div class="modal-title-div">
                                <span class="modal-title">Notes of Quote</span>
                            </div>
                            <div class="modal-top-right-div">

                            </div>
                        </div>

                        <div class="all-notes-div" style="margin:20px 0px 20px 0px">
                            
                            {{-- <div class="single-note">
                                <div class="card-design">
                                    <div>
                                        <div>
                                            <span class="single-note-number">1.</span> <span class="single-note-text"> Hello
                                            </span>
                                        </div>
    
                                        <div class="added-by-div">
                                            <span class="added-by"> Added by : <span class="added-by-text"> Hellooooo</span>
                                            </span>
                                        </div>
                                    </div>
                                    
                                </div>

                            </div> --}}

                          
                        </div>
                        <form method="POST" action="{{route('user.create.note')}}">
                            @csrf
                            <input type="hidden" name="quote_id" id="quote_id_for_note">
                            <div class="description">
                                <label style="margin-bottom: 15px" for="">Add Your Note</label>

                                <div class="">
                                    <textarea class="form-control" rows="4" name="note" placeholder="Leave a note here"></textarea>
                                </div>
                            </div>
                            <div class="send-btn">
                                <button type="submit" class="btn send">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('partials.user.filter')

    @include('user.components.job')

    @include('partials.footer')




@endsection

@section('script')
    <script>
        function getJobData(i, startTime, endtTime, jobStatus) {

            $.ajax({
                url: `/user/user-jobs`,
                method: 'GET',
                dataType: 'json',
                data: {
                    'clicked': i,
                    'start_time': startTime,
                    'end_time': endtTime,
                    'job_status': jobStatus
                },
                success: data => {
                    console.log(data);
                    if (data.html.length > 0) {
                        $(".no-data-found").html('')
                        if (i == 0) {
                            $('.JobData').html(data.html);
                        } else {
                            $('.JobData').append(data.html);
                        }

                        $('.showing_data_value').text(data.showingData);
                        $('.total_data_value').text(data.totalData);

                        if (data.showingData == data.totalData) {
                            $('.pagination-div button').addClass("disable");
                            $('.pagination-div > button').hide();
                        }
                        else{
                            $('.pagination-div button').removeClass("disable");
                            $('.pagination-div > button').show();
                        }

                    } else {
                        if (i == 0) {
                            $('.JobData').html("");
                            $(".no-data-found").html('No Data Found')
                            $('.pagination-div').hide();
                        }
                    }
                    console.log(data)
                },
                error: error => {
                    console.log(error)
                }
            });


        }

        getJobData(0, null, null, 0)

        function getMoreData() {
            let numVal = $('.numberValue').text();
            let increasedVal = ++numVal;
            $('.numberValue').text(increasedVal);
            let startTime = $('#datePickerStartTime').val();
            let endtTime = $('#datePickerEndTime').val();
            if (startTime === "" || startTime === null || startTime === undefined) {
                startTime = null;
            } else {
                startTime = startTime;
            }
            if (endtTime === "" || endtTime === null || endtTime === undefined) {
                endtTime = null;
            } else {
                endtTime = endtTime;
            }
            let jobStatus = $('#status_val').val()
            getJobData(increasedVal, startTime, endtTime, jobStatus)

        }
    </script>

    <script>
        function jobStatusChange(id, status) {
            $('#quote_id_for_status_change').val(id);

            const selectElement = $('.status-types');

            // Loop through the options and set 'selected' on the matching option
            selectElement.find('option').each(function() {
                if ($(this).val() === status) {
                    $(this).prop('selected', true);
                    return false; // Stop looping once a match is found
                }
            });




            $("#changeModal").modal('show');

        }

        $('.send').click(function() {
            $('.send').html("Sending...please Wait");
        })
    </script>
@endsection
