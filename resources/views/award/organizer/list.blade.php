@if($awards->isEmpty())
	<p>There are no awards.</p>
@endif

@if(!$awards->isEmpty())
<ul class="list-group">
  @foreach($awards as $award)
	  <li class="award list-group-item">
			<span class="name">{{ $award->name }}</span>

			@if($award->description)
				<span class="description">{{ $award->description }}</span>
			@endif

			<span class="owner">{{ $award->owner() }}</span>

			@if($award->pivot)
				@if($award->pivot->recipient || $award->choirs->first())
					<span class="recipient">
						<span class="heading">Recipient:</span>
						@if($award->pivot->recipient)
							<span class="name">{{ $award->pivot->recipient }}</span>
						@endif
						@if($award->choirs->first())
							<span class="choir">{{ $award->choirs->first()->name }}</span>
						@endif
					</span>
				@endif

				@if($award->pivot->sponsor)
					<span class="sponsor">
						<span class="heading">Sponsor:</span>
						<span class="name">{{ $award->pivot->sponsor }}</span>
					</span>
				@endif
			@endif

			<ul class="actions-group">
				@can('update',$award)
					<li>
						<a class="action" href="{{ route('organizer.award.edit',[$award]) }}">Edit</a>
					</li>
				@endcan
			</ul>

		</li>
  @endforeach
</ul>
@endif
