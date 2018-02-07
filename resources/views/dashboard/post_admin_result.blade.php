@extends('layouts.dashboard')
<style>
  .feedback{
    font-size: 14pt;
    margin: 20px;
  }
  .success{
    color: green;
  }
  .error{
    color: red;
  }
</style>
@section('pg')
<div class="container" dir="auto">
  @if($sql_success)
      <span class="feedback success"> @lang('messages.changes_successfully') </span>
            <br/><br/>
  @else
  <span class="feedback error">There was an error</span>
      <br/><br/>
  @endif

</div>
@endsection
