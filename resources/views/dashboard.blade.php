@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h2>{{ $userName }}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="vertical-spacer-40">
                    <a class="btn btn-default" href="/build-list">Build</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <ul id="dashboardTabs" class="nav nav-tabs vertical-spacer-40" role="tablist">
                    <li>
                        <a href="#resources" data-toggle="tab" aria-controls="resources" aria-expanded="true">Resources @if($rCount)({{ $rCount }})@endif</a>
                    </li>
                    <li class="active">
                        <a href="#content" data-toggle="tab" aria-controls="content" aria-expanded="true">My Published Content @if($pCount)({{ $pCount }})@endif</a>
                    </li>
                    <li>
                        <a href="#progress" data-toggle="tab" aria-controls="progress" aria-expanded="true">Work in Progress @if($wipCount)({{ $wipCount }})@endif</a>
                    </li>
                    <li>
                        <a href="#feedback" data-toggle="tab" aria-controls="feedback" aria-expanded="true">Feedback Needed @if($fCount)({{ $fCount }})@endif</a>
                    </li>  
                    @if(Session::has('user.reviewer'))    
                        <li>
                        <a href="#reviews" data-toggle="tab" aria-controls="reviews" aria-expanded="true">Reviews Requested @if($rCount)({{ $rCount }})@endif</a>
                        </li> 
                    @endif     
                </ul> 
                <div id="tabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane" id="resources" aria-labelledby="content"> 
                        @if($resourcesSearch)
                        <div id="resources-search" data-resources="{{ $resourcesSearch }}"></div>
                        @else
                            <p>No resources have been published yet.</p>
                        @endif 
                    </div>
                    <div role="tabpanel" class="tab-pane active" id="content" aria-labelledby="content"> 
                        @if (! empty($published))
                            @foreach($published as $item)
                                <div class="row vertical-spacer-20">
                                    <div class="col-md-8">
                                        <a href="/artifact/{{$item->id}}">{{ $item->title }}</a>
                                    </div>
                                    <div class="col-md-4 ">
                                        @if($item->reviewsLink)
                                            <a class="btn btn-default" href="{{$item->reviewsLink}}">reviews</a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>You have not published any content yet.</p>
                        @endif 
                    </div>
                <div role="tabpanel" class="tab-pane" id="progress" aria-labelledby="progress"> 
                        @if (! empty($workInProgress))
                            @foreach($workInProgress as $item)
                                <div class="row vertical-spacer-20">
                                    <div class="col-md-8">
                                        {{ $item->title }}
                                    </div>
                                    <div class="col-md-4">
                                    @if($item->reviewsLink)
                                        <a class="btn btn-default" href="{{$item->reviewsLink}}">reviews</a>
                                    @endif
                                        <a class="btn btn-default" href="/artifact-edit/{{$item->id}}">edit</a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>You do not have any work in progress.</p>
                        @endif 
                </div>
                <div role="tabpanel" class="tab-pane" id="feedback" aria-labelledby="feedback"> 
                        @if (! empty($feedback))
                            @foreach($feedback as $item)
                                <div class="row vertical-spacer-20">
                                    <div class="col-md-8">
                                        {{ $item->title }} - {{ $item->section_title }} by {{ $item->author }}
                                    </div>
                                    <div class="col-md-4 ">
                                        <a class="btn btn-default" href="/artifact-collaboration/{{$item->id}}/{{ $item->section_id }}">add feedback</a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No feedback is needed at this time</p>
                        @endif 
                </div>
                <div role="tabpanel" class="tab-pane" id="reviews" aria-labelledby="reviews"> 
                        @if (! empty($reviews))
                            @foreach($reviews as $review)
                                <div class="row vertical-spacer-20">
                                    <div class="col-md-8">
                                        {{ $review->title }} by {{ $review->author }}
                                    </div>
                                    <div class="col-md-4 ">
                                        <a class="btn btn-default" href="/submit-review/{{$review->id}}">review</a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No reviews requested at this time.</p>
                        @endif 
                </div>
            </div>
        </div>
    </div>     
</div>
@endsection