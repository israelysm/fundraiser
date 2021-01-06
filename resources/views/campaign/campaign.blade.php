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
      
      <section>
        

        <b-table
            :data="isEmpty ? [] : data"
            :bordered="isBordered"
            :striped="isStriped"
            :narrowed="isNarrowed"
            :hoverable="isHoverable"
            :loading="isLoading"
            :focusable="isFocusable"
            :mobile-cards="hasMobileCards">

            <b-table-column field="id" label="ID" width="40" numeric v-slot="props">
                @{{ props.row.id }}
            </b-table-column>

            <b-table-column field="first_name" label="First Name" v-slot="props">
                @{{ props.row.first_name }}
            </b-table-column>

            <b-table-column field="last_name" label="Last Name" v-slot="props">
                @{{ props.row.last_name }}
            </b-table-column>

            <b-table-column field="date" label="Date" centered v-slot="props">
                <span class="tag is-success">
                    @{{ new Date(props.row.date).toLocaleDateString() }}
                </span>
            </b-table-column>

            <b-table-column label="Gender" v-slot="props">
                <span>
                    <b-icon pack="fas"
                        :icon="props.row.gender === 'Male' ? 'mars' : 'venus'">
                    </b-icon>
                    @{{ props.row.gender }}
                </span>
            </b-table-column>

        </b-table>
    </section>


</div>
@endsection

@include('campaign.campaignscript')