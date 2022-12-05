@extends('layouts.backend.app')

@section('title', __('Edit Referral Commission'))

@section('head')
    @include('layouts.backend.partials.headersection', ['title' => __('Edit Referral Commission'), 'prev'=> route('admin.referral-commission.index')])
@endsection

@section('content')
<section class="section">
   <div class="row">
      <div class="col-lg-12">
         <form class="ajaxform" method="post" action="{{ route('admin.referral-commission.update', $referralCommission->id) }}">
            @csrf
            @method('PUT')
            <div class="row">
               {{-- left side --}}
               <div class="col-lg-5">
                  <strong>{{ __('Description') }}</strong>
                  <p>{{ __('Add your Review details and necessary information from here') }}</p>
               </div>
               {{-- left side --}}
               {{-- right side --}}
               <div class="col-lg-7">
                  <div class="card">
                     <div class="card-body">
                         <div class="from-group mb-4">
                             <label for="title">{{ __('Title :') }} </label>
                             <input type="text" name="title" id="title" class="form-control"
                                    value="{{ $referralCommission->name }}" placeholder="{{ __('Enter Title') }}">
                         </div>
                         <div class="from-group mb-4">
                             <label for="commission_type"
                                 >{{ __('Commission Type :') }} </label>
                             <select name="commission_type" id="commission_type" class="form-control">
                                 <option value="percentage" @selected($referralCommission->slug == 'percentage')>{{ __('Percentage') }}</option>
                                 <option value="fixed" @selected($referralCommission->slug == 'fixed')>{{ __('Fixed') }}</option>
                             </select>
                         </div>
                         <div class="from-group mb-4">
                             <label for="commission">{{ __('Commission :') }} </label>
                             <input type="number" name="commission" id="commission" class="form-control"
                                    value="{{ $referralCommission->other }}" placeholder="{{ __('Enter commission') }}">
                         </div>
                        <input type="hidden" name="type" value="ReferralCommission">

                        <div class="row">
                           <div class="col-lg-12">
                              <button class="btn btn-primary basicbtn" type="submit">
                                  <i class="fas fa-save"></i>
                                  {{ __('Save') }}
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
</section>
@endsection
