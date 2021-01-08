@extends('includes.layout')

@section('title', 'Campaigns')

@section('style')
  @include('campaign.campaignstyle')
@endsection

@section('side-menu')
      @include('sidemenu')
@endsection

@section('content')
<h1 class="title has-text-centered">Campaigns</h1>
<div class="columns">
    <div class="column is-6 pl-0"><button @click="isComponentModalActive = true" class="button is-link is-outlined">New Campaign</button></div>
    <div class="column is-6"></div>
</div>

<div class="columns is-flex-wrap-wrap">
      
        <campaign-card v-for="(campaign,index) in campaignlist"
            v-bind="campaign"
            :index="index"
            v-on:editcampaign="editcampaign($event)"
            :key="index"
        ></campaign-card>
</div>
<b-modal 
    v-model="isComponentModalActive"
    has-modal-card
    :can-cancel="false">
    <modal-form v-bind="formProps" v-on:formdata="submit($event)"></modal-form>
</b-modal>

@endsection
@section('template-component')
    @include('campaign.newcampaign')
    @include('campaign.campaigncard')
@endsection
@section('registar-template-component')
    ModalForm,
@endsection

@include('campaign.campaignscript')