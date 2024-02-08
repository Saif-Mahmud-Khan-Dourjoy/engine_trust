<div class="filter-div">
 
    <div class="left-div">
        @if (request()->path() != 'user/invoices')
            <div class="date-range">
                <input type="text" name="daterange" class="dateRange" placeholder="Date Range">
                <i class="fa-regular fa-calendar select-date-range"></i>

            </div>
            <input type="hidden" name="" id="datePickerStartTime">
            <input type="hidden" name="" id="datePickerEndTime">
        @endif
        @if (request()->path() == 'user/invoices')
        <div class="">
            <input type="text" name="" class="invoice-input invoice-no-invoice" placeholder="invoice no." oninput="invoiceNo(event)">
            

        </div>
        <div class="">
            <input type="text" name="" class="invoice-input invoice-no-car" placeholder="car name" oninput="invoiceCar(event)">
            

        </div>
        @endif
        {{-- <div class="choose">
            <span>choose a make...</span>
        </div> --}}
        {{-- <div class="search">
            <div class="select-div">
                <div class="select-with-icon">
                    <select class="form-select type-select-filter" aria-label="Default select example">
                        <option selected>Car Type</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>


                    </select>

                </div>
                <div class="form-group">

                    <input type="text" class="form-control search-input" id="exampleInputsearch1"
                        aria-describedby="searchHelp" placeholder="search" />
                </div>
            </div>

        </div> --}}
    </div>

    {{-- <div class="right-div">
        <button class="btn filter-btn filter-right-div-btn-active">
            All
        </button>

        <button class="btn filter-btn">Hide</button>

        <button class="btn filter-btn">Quote</button>
    </div> --}}
    @if (request()->path() == 'user/job')
        <div class="filter-by-status-div">
            <div class="filter-title">Filter By:</div>
            <div>
                <select class="form-select " id="status_val" onchange="changeStausValue()"
                    aria-label="Default select example">
                    <option value="0">Job Status</option>
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
        </div>
    @endif
    @if (strpos(request()->path(), 'user/enquiry') !== false)
        <div>
            <button style="font-size: 12px;border-radius:8px" class="btn btn-outline-danger"
                onclick="deleteAllQuery()">Delete all query</button>
            <button style="font-size: 12px;border-radius:8px" class="btn btn-danger"
                onclick="deleteSelectedQuery()">Delete selected query</button>
        </div>
    @endif
    @if (strpos(request()->path(), 'user/quotes') !== false)
        <div>
            <button style="font-size: 12px;border-radius:8px" class="btn btn-outline-danger"
                onclick="deleteAllQuotes()">Delete all quotes</button>
            <button style="font-size: 12px;border-radius:8px" class="btn btn-danger"
                onclick="deleteSelectedQuotes()">Delete selected quotes</button>
        </div>
    @endif
    @if (strpos(request()->path(), 'user/hidden') !== false)
        <div>
            <button style="font-size: 12px;border-radius:8px" class="btn btn-outline-danger"
                onclick="deleteAllHidden()">Delete all hidden</button>
            <button style="font-size: 12px;border-radius:8px" class="btn btn-danger"
                onclick="deleteSelectedHidden()">Delete selected hidden</button>
        </div>
    @endif
</div>
