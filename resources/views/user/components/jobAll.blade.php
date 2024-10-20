  @php
      $arrBackground = [
          'Work Started' => 'rgba(201, 73, 5, 0.10)',
          'Inspection Done' => 'rgba(255, 199, 0, 0.10)',
          'Engine Ready' => 'rgba(72, 164, 227, 0.10)',
          'Deposit Pending' => 'rgba(11, 93, 162, 0.10)',
          'Deposit Received' => 'rgba(222, 120, 8, 0.10)',
          'Reached Garage' => 'rgba(191, 97, 150, 0.10)',
          'Ready for Collection' => 'rgba(105, 191, 112, 0.10)',
          'Job Completed' => 'rgba(19, 143, 96, 0.10)',
      ];
      $arrBorder = [
          'Work Started' => '1px solid #C94905',
          'Inspection Done' => '1px solid #FFC700',
          'Engine Ready' => '1px solid #48A4E3',
          'Deposit Pending' => '1px solid #0B5DA2',
          'Deposit Received' => '1px solid #DE8E08',
          'Reached Garage' => '1px solid #BF6196',
          'Ready for Collection' => '1px solid #69BF70',
          'Job Completed' => '1px solid #138F60',
      ];
      $arrColor = [
          'Work Started' => '#C94905',
          'Inspection Done' => '#FFC700',
          'Engine Ready' => '#48A4E3',
          'Deposit Pending' => '#0B5DA2',
          'Deposit Received' => '#DE8E08',
          'Reached Garage' => '#BF6196',
          'Ready for Collection' => '#69BF70',
          'Job Completed' => '#138F60',
      ];

  @endphp
  <div>

  </div>

  <div class="table-value">

      <div class="name table-single-value">
          <input type="checkbox" id="name_checkbox1" name="name_checkbox_value[]" />
          <span>{{ $item->enquiry->car_model . ' ' . $item->enquiry->car_reg_year }}</span>
      </div>
      <div class="date_time table-single-value">
          <span>{{ date('M d, Y \a\t h:i A', strtotime($item->enquiry->created_at)) }}</span>
      </div>
      <div class="ref table-single-value">
          <span>{{ $item->enquiry->ref_no }}</span>
      </div>
      <div class="request_details table-single-value">
          <span>{{ $item->enquiry->request_part }}</span>
      </div>
      <div class="status table-single-value" id="status-change-div"
          onclick="jobStatusChange('<?php echo $item->id; ?>','<?php echo $item->job_status[count($item->job_status) - 1]->status; ?>')">
          <div class="status-div"
              style="width: 100%; cursor: pointer;background:{{ $arrBackground[$item->job_status[count($item->job_status) - 1]->status] }};border:{{ $arrBorder[$item->job_status[count($item->job_status) - 1]->status] }}">

              <span
                  style="font-weight: 500;color:{{ $arrColor[$item->job_status[count($item->job_status) - 1]->status] }}">{{ $item->job_status[count($item->job_status) - 1]->status }}</span>

              <i class="fa-solid fa-arrow-down" style="font-size: 12px"></i>
          </div>
      </div>

      <div class="action table-single-value">
          <i style="cursor: pointer;"
              class="fa-solid fa-ellipsis-vertical action-main-button-to-click job-action-button"
              onclick="toggleActionJob(event)"></i>
          <div class="action-btn-div display-toggle-common">
              <div class="action-btn-element">
                  <div style="cursor: pointer" class="edit" onclick="viewJob('<?php echo $item->id; ?>')">View Quotes</div>
                  <div style="cursor: pointer" class="delete" onclick="invoiceJob('<?php echo $item->id; ?>')">Invoice</div>
                  <div style="cursor: pointer" class="edit" onclick="noteJob('<?php echo $item->id; ?>')">Notes</div>
                  <div style="cursor: pointer" class="delete">
                      {{ $item->job_status[count($item->job_status) - 1]->email_status === 1 ? 'Email opened' : 'Email not opened' }}
                  </div>

                  <div style="cursor: pointer" class="issue" onclick="issue('<?php echo $item->enquiry->id; ?>')">Car Issue</div>
                  <div style="cursor: pointer" class="issue" onclick="history('<?php echo $item->id; ?>')">Status History
                  </div>
              </div>
          </div>
      </div>
  </div>
