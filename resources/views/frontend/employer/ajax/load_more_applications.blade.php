@foreach($apply_jobs as $apply_job)
    <div class="application">
        <div class="app-content">

            <!-- Name / Avatar -->
            <div class="info">
                <img src="{{asset($apply_job->candidate->avatar)}} " alt="">
                <span></span>
                <ul>
                    <li><a href="#"><i class="fa fa-file-text"></i> Download CV</a></li>
                    <li><a href="#"><i class="fa fa-envelope"></i> Contact</a></li>
                </ul>
            </div>
            <!-- Buttons -->
            <div class="buttons">
                <a href="#edit-{{$apply_job->id}}" class="button gray app-link"><i class="fa fa-pencil"></i> Edit</a>
                <a href="#add-node-{{$apply_job->id}}" class="button gray app-link"><i class="fa fa-sticky-note"></i> Add Note</a>
                <a href="#show-detail-{{$apply_job->id}}" class="button gray app-link"><i class="fa fa-plus-circle"></i> Show Details</a>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--  Hidden Tabs -->
        <div class="app-tabs">
            <a href="#" class="close-tab button gray"><i class="fa fa-close"></i></a>
            <!-- First Tab -->
            <div class="app-tab-content closed" style="display: none" id="edit-{{$apply_job->id}}">
                <form action="{{route('application.update', $apply_job->id)}}" method="post">

                    <div class="select-grid">
                        <select data-placeholder="Application Status" name="status" class="chosen-select-no-single">
                            <option value="">Application Status</option>
                            @foreach($application_status as $status)
                                <option {{$status->id == $apply_job->applicationStatus->id ? 'selected' : ''}} value="{{$status->id}}">{{$status->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="select-grid">
                        <input style="padding: 9px 18px;"  type="number" name="rating" min="1" max="5" placeholder="Rating (out of 5)">
                    </div>
                    <div class="clearfix"></div>
                    <input type="hidden" name="type" value="edit">
                    @csrf
                    @method('PUT')
                    <input type="submit" class="margin-top-15 button" value="Save">
                    <a href="#" data-target="{{route('application.destroy', $apply_job->id)}}" class="button gray margin-top-15 delete-application Alert_delete">Delete this application</a>
                </form>
            </div>
            <!-- Second Tab -->
            <div class="app-tab-content closed" style="display: none" id="add-node-{{$apply_job->id}}">
                <form action="{{route('application.update', $apply_job->id)}}" method="post">
                    <textarea name="note" placeholder="Private note regarding this application">{{$apply_job->note}}</textarea>
                    <input type="hidden" name="type" value="add-node">
                    <input type="submit" class="margin-top-15 button" value="Add Note">
                    @csrf
                    @method('PUT')
                </form>
            </div>
            <!-- Third Tab -->
            <div class="app-tab-content closed" style="display: none" id="show-detail-{{$apply_job->id}}">
                <i>Full Name:</i>
                <span>{{$apply_job->candidate->first_name . ' ' . $apply_job->candidate->last_name}}</span>

                <i>Email:</i>
                <span><a href="mailto:{{$apply_job->email}}">{{$apply_job->email}}</a></span>

                <i>Message:</i>
                <span>{{$apply_job->message}}</span>
            </div>
        </div>
        <!-- Footer -->
        <div class="app-footer">

            <div class="rating no-stars">
                <div class="stars">
                    <svg width="100" height="100" viewBox="0 0 940.688 940.688">
                        <path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8 c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601 c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z" />
                    </svg>
                    <svg width="100" height="100" viewBox="0 0 940.688 940.688">
                        <path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8 c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601 c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z" />
                    </svg>
                    <svg width="100" height="100" viewBox="0 0 940.688 940.688">
                        <path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8 c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601 c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z" />
                    </svg>
                    <svg width="100" height="100" viewBox="0 0 940.688 940.688">
                        <path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8 c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601 c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z" />
                    </svg>
                    <svg width="100" height="100" viewBox="0 0 940.688 940.688">
                        <path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8 c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601 c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z" />
                    </svg>
                    <div class="overlay" style="width: {{(5-$apply_job->candidate->rating)*20}}%"></div>
                </div>
            </div>

            <ul>
                <li>{{$apply_job->updated_at}}</li>
                <li>({{getDayDifference($apply_job)}})</li>
                <li><i class="fa fa-calendar"></i></li>
            </ul>
            <div class="clearfix"></div>

        </div>
    </div>
@endforeach
<span id="have-more" data-have-more="{{$have_more}}"></span>
