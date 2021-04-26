@if($judges->isEmpty())
	<p>There are no judges.</p>
@endif

@if(!$judges->isEmpty())
<ul class="list-group">
  @foreach($judges as $judge)
	  <li class="judge list-group-item">
			<span class="name">{{ $judge->full_name }}</span>

      <ul class="captions-group">
      @foreach($captions as $caption)

          @if(in_array($caption->id, $judge->captions->pluck('id')->toArray() ))
            <li class="{{ $caption->slug }} caption label {{ $caption->background_css }}">{{ $caption->name }}</li>
          @endif


      @endforeach
      </ul>


			<ul class="actions-group">
				@can('updateJudge', $division)
					<li>
						{{ link_to_route('organizer.competition.division.judge.edit', 'Edit Captions', [$division->competition,$division,$judge], ['class' => 'action']) }}
					</li>
				@endcan
				@if($judge->user)
					<li>
						{{ link_to_route('user.password.edit', 'Change Password', [$judge->user->id], ['class' => 'action']) }}
					</li>
				@endif
			</ul>

		</li>
  @endforeach
</ul>
@endif
