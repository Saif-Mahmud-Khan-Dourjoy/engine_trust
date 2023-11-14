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
                    <form action="('user.job.statusChange') }}" method="POST" enctype="multipart/form-data">
                        @csrf
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
                                <input type="hidden" name="quote_id" id="quote_id">
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


    @include('partials.user.filter')

    @include('user.components.job')

    @include('partials.footer')




@endsection

@section('script')
    <script>
        function getJobData(i,startTime, endtTime,jobStatus) {

            $.ajax({
                url: `/user/user-jobs`,
                method: 'GET',
                dataType: 'json',
                data: {
                    'clicked': i,
                    'start_time': startTime,
                    'end_time': endtTime,
                    'job_status':jobStatus
                },
                success: data => {
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
                        
                    }  else{
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

        getJobData(0,null,null,0)

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
            let jobStatus=$('#status_val').val()
            getJobData(increasedVal, startTime, endtTime,jobStatus)  

        }
    </script>

    <script>
        function jobStatusChange(id, status) {


            const selectElement = $('.status-types');

            // Loop through the options and set 'selected' on the matching option
            selectElement.find('option').each(function() {
                if ($(this).val() === status) {
                    $(this).prop('selected', true);
                    return false; // Stop looping once a match is found
                }
            });

            $('#quote_id').val(id);


            $("#changeModal").modal('show');
        }

        $('.send').click(function(){
            $('.send').html("Sending...please Wait");
        })
    </script>
@endsection
