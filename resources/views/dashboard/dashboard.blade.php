@extends('includes.layout')

@section('title', 'Dashboard')

@section('style')
  @include('dashboard.dashboardstyle')
@endsection

@section('side-menu')
      @include('sidemenu')
@endsection

@section('content')
<div class="columns">
      <section class="column is-5">
        <b-collapse class="card" animation="slide" aria-id="contentIdForA11y3">
            <div
                slot="trigger" 
                slot-scope="props"
                class="card-header"
                role="button"
                aria-controls="contentIdForA11y3">
                <p class="card-header-title">
                    Component
                </p>
                <a class="card-header-icon">
                    <b-icon
                        :icon="props.open ? 'menu-down' : 'menu-up'">
                    </b-icon>
                </a>
            </div>
            <div class="card-content">
                <div class="content">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec iaculis mauris.
                    <a>#buefy</a>.
                </div>
            </div>
            <footer class="card-footer">
                <a class="card-footer-item">Save</a>
                <a class="card-footer-item">Edit</a>
                <a class="card-footer-item">Delete</a>
            </footer>
        </b-collapse>
      </section>

      <section class="column is-5">
        <div class="card" animation="slide">
        <div class="card-header">
                <p class="card-header-title">
                  New Campaign
                </p>
            </div>
            <div class="card-content">
                <div class="content has-text-centered">
                <b-icon icon="plus"> </b-icon>
                </div>
            </div>
        </div>
      </section>
</div>
@endsection

@section('script')
  @include('dashboard.dashboardscript')
@endsection