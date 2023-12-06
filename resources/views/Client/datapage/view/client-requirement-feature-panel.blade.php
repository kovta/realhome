@php
    use App\Models\ClientRequirement;
    /**
    * @var ClientRequirement $clientRequirement
    */
@endphp
<div id="collapse-3" class="collapse show" aria-labelledby="heading-3" data-parent="#leftSections">
        <div class="card-body">
            <div class="row">
                @php
                    $counter = 0;
                    $clientRequirementItem = ClientRequirement::$features;
                    array_push($clientRequirementItem, "furniture", "garden");
                @endphp
                @foreach($clientRequirementItem as $item)
                    @if($clientRequirement->$item == 1)
                        @if ($counter%4 == 0)
                            <div class="col-sm-6">
                                <div class="more_details">
                                    <ul>
                                        @endif
                                        <li class="color-secondery" style="list-style-type: none ">
                                            <i class="fas fa-check"></i>
                                            <span class="color-primary" style="font-weight: normal !important;">{{ __('messages.real_estates_datapage_'.$item.'_label') }}</span>
                                        </li>
                                        @php $counter++;@endphp
                                        @if ($counter%4 == 0)
                                    </ul>
                                </div>
                            </div>
                            @endif
                            @endif
                            @endforeach
                            @if ($counter%4 != 0)
                            </ul>
                </div>
            </div>
            @endif
            </div>
        </div>
    </div>
