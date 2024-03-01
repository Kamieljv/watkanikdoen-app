<template>
    <div>
        <div class="form-group mb-2">
			<div class="w-full text-sm my-2 mb-5 mx-1">
				<label>
					<input v-model="recurring" type="checkbox"/>
					Dit is een herhalende actie.
				</label>
			</div>
            
            <div v-if="!recurring" class="w-full">
                deze actie is niet recurring
            </div>
            <div v-else class="w-full">
				deze actie is recurring
            </div>

			<!-- <div class="form-group @if($row->type == 'hidden') hidden @endif">
				<label for="time_start">{{ $row->display_name }}</label>
				<input class="form-control" type="datetime-local" name="time_start" value="{{old('time_start', $dataTypeContent->time_start ?? '')}}" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}"/>
				@foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
					{!! $after->handle($row, $dataType, $dataTypeContent) !!}
				@endforeach
			</div>
			<div class="form-group @if($row->type == 'hidden') hidden @endif">
				<label for="time_end">{{ $row->display_name }}</label>
				<input class="form-control" type="datetime-local" name="time_end" value="{{old('time_end', $dataTypeContent->time_end ?? '')}}" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}"/>
				@foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
					{!! $after->handle($row, $dataType, $dataTypeContent) !!}
				@endforeach
			</div> -->
        </div>
    </div>
</template>

<script>
export default {
	name: "ActieDateTimeFormField",
	props: {
		//
	},
	data() {
		return {
			recurring: false
		}
	},
	mounted() {
		//
	},
}
</script>

<style lang="scss" scoped>
</style>
