@extends('front.layouts.master', ['title'=> 'Mentor Signup', 'pageName' => 'mentor-signup-4'])
@section('content')
<link rel="stylesheet" type="text/css" href="<?=env('FRONT_ASSETS_URL')?>assets/css/bvselect.css">
<section class="mentor_element">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="metor_dashboard_top">
               <div class="metor_progess">
                  <div class="stepper-wrapper">
                     <div class="stepper-item first + completed"></div>
                     <div class="stepper-item  + completed"></div>
                     <div class="stepper-item  + completed">
                     </div>
                     <div class="stepper-item  + active">
                        <img class="img-fluid" src="{{ env('FRONT_ASSETS_URL') }}assets/images/bulb_icon.png" alt="logo">
                     </div>
                     <div class="last-counter stepper-item  + ">
                        <div class="progress-dot step-counter"></div>
                     </div>
                  </div>
                  <div class="me_probar"></div>
                  <!--<div class="met_prolight"><img class="img-fluid" src="{{ env('FRONT_ASSETS_URL') }}assets/images/bulb_icon.png" alt="logo"></div>-->
               </div>
            </div>
         </div>
      </div>
      <div class="row justify-content-around">
         <div class="col-lg-7 col-md-8 col-sm-8">
            <div class="metor_dashboard">
               <div class="metor_information">
                  <h2>Great! Now let's set your availability</h2>
                  <p class="text-muted mb-4">Let your audience know when you're available. You can edit this later</p>
                  <div class="metor_step1_form">
                  @if ($errors->any())
                     <div class="invalid-feedback d-block" role="alert">
                        <ul>
                           @foreach (json_decode($errors) as $file_index => $error)
                           <li>
                              <strong>{{$file_index.': '}}
                              <ul>
                                 @foreach ($error as $error_item)
                                    <li>{{$error_item}}</li>
                                 @endforeach
                              </ul>
                              </strong>
                           </li>
                           @endforeach
                        </ul>
                        </div>
                  @endif
                     <form action="{{ route('mentor.create.step4') }}" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                        @csrf
                        <div class="ant-col ant-col-24 add-slots mentoe_admin_section">
                           <div class="row slot-item hide_tabmobile">
                              <div class="col-md-3"></div>
                              <div class="col-md-9">
                                 <div class="row">
                                    <div class="col-md-3 text-center"><span class="fw-bold" style="color: #f9233f;">Start</span></div>
                                    <div class="col-md-3 text-center"><span class="fw-bold" style="color: #f9233f;">Duration</span></div>
                                    <div class="col-md-3 text-center"><span class="fw-bold" style="color: #f9233f;">No. Of Slots</span></div>
                                    <div class="col-md-3 text-left"><span class="fw-bold" style="color: #f9233f;">End</span></div>
                                 </div>
                              </div>
                           </div>

                           @foreach($days AS $day)
                           <div class="row slot-item">
                              <div class="col-md-3">
                                 <div class="slot_weeksday">
                                    <div class="form-check">
                                       <input class="form-check-input chk__slots__show__hide" type="checkbox" name="day_of_week[{{ $day->id }}]" value="{{ $day->day }}" data-chkcontainer="{{ strtolower($day->day_text) }}" id="flexCheckChecked_{{ $loop->index }}"
                                        {{ (in_array($day->day_index, [])) ? 'checked' : '' }}>

                                       <label class="form-check-label" for="flexCheckChecked">

                                        {{ $day->day_text }}
                                       </label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-9 slots__parent">
                                 @if(in_array($day->day_index, []))
                                 <div class="slots-section">
                                    <div class="slots-select-box">
                                       <div class="slot_starttime">
                                          <select class="select2-frm" name="availability[from][{{ $day->id }}][]">
                                             @foreach($slot_dropdown AS $option)
                                             <option value="{{ $option['value'] }}"
                                             {{ ($option['selected_from'] == $option['value']) ? 'selected' : '' }}>
                                              {{ $option['name'] }}</option>
                                             @endforeach
                                          </select>
                                       </div>
                                       <div style="display: inline; margin: 0px 0.2em;">-</div>
                                       <div class="slot__duration">
                                        <select class="select__slot__duration" name="duration[{{ $day->id }}][]" style="width: 50%">
                                        </select>
                                       </div>
                                       <div style="display: inline; margin: 0px 0.2em;">-</div>

                                       <div class="no__of__slots">
                                        <select class="select__no__ofslot" name="no_of_slot[{{ $day->id }}][]" style="width: 50%">
                                        </select>
                                       </div>
                                       <div style="display: inline; margin: 0px 0.2em;">-</div>
                                       <div class="slot_endtime">
                                        <input type="text" class="slot__endtime__txt" name="availability[to][{{ $day->id }}][]" value="{{ date('g:i A', strtotime($option['selected_to'])) }}" readonly="readonly">
                                        </div>
                                       <button class="add-slot-btn add__slot__parent" data-container="{{ strtolower($day->day_text) }}"><span style="pointer-events: none;"><i class="fa-solid fa-plus"></i></span></button>
                                    </div>
                                    @if($loop->index === 0)
                                    <!-- <div class="btn-apply-all"><a href="#">Apply To All</a></div> -->
                                    @endif

                                 </div>
                                    @else
                                    <div class="ant-typography slots-unavailable">Unavailable</div>

                                    @endif
                                    <div class="slot__items__component" id="item-list-container-{{ strtolower($day->day_text) }}">
                                    </div>
                              </div>
                           </div>
                           @endforeach

                        </div>
                        </br>
                        </br>
                        <!-- <label><small>Document Preference</small></label> -->
                        <p class="text-muted mb-2">Document Preference</p>
                        <div class="form-group mt-1 pt5">
                           <select class="docoument_selet form-select" name="document_head" id="document_head">
                              <option value="">Select Any one of the document</option>
                              @foreach($documents AS $document)
                                 <option value="{{ $document->id }}">{{ $document->document }}</option>
                              @endforeach
                           </select>
                        </div>
                        @foreach($documents AS $document)
                        <div class="form-group pt-1 hide" id="{{ strtolower(str_replace(' ', '_', $document->id)) }}">
                           <label>{{ $document->document }}</label>
                           <label><small>Max 1 mb in size and supported format (Jpg/Jpeg/pdf)</small></label>
                           <input type="file" class="form-control" name="docs_attachment[{{ $document->document }}]">
                        </div>
                        @endforeach
                        <div class="input-group mb-3">
                           <button class="next-btn">Next</button>
                           <!-- <a href="mentor3.html" class="next-btn">Finish</a> -->
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="rightside_testslider">
               <div class="login_sidebar_testimorial">
                  @include('front.elements.side-testimonial-platform')
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection
@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
//Initialize select2
const noofslot= [
            {
                "id": 1,
                "text": 'x 1 slot',

            },
            {
                "id": 2,
                "text": 'x 2 slots'
            },
            {
                "id": 3,
                "text": 'x 3 slots'
            },
            {
                "id": 4,
                "text": 'x 4 slots'
            },
            {
                "id": 5,
                "text": 'x 5 slots'
            },
            {
                "id": 6,
                "text": 'x 6 slots'
            },
            {
                "id": 7,
                "text": 'x 7 slots'
            },
            {
                "id": 8,
                "text": 'x 8 slots'
            },
            {
                "id": 9,
                "text": 'x 9 slots'
            },
            {
                "id": 10,
                "text": 'x 10 slots',

            },
            {
               "id": 11,
               "text": 'x 11 slots',
               // "selected": true,

            }
        ];
        const duration= [
            {
                "id": 30,
                "text": '30 minutes'
            },
            {
                "id": 60,
                "text": '60 minutes',
                "selected": true,

            }
        ];

$('.select2-frm').select2({
    placeholder: "Select an time",
    });

    //$('.select2-to').select2();
//const parentaddItmBtn= document.querySelectorAll('.add-slots > div');
//const addItmBtn= document.querySelectorAll('.add-slot-btn');
const addItmBtn= document.querySelectorAll('.slots__parent');
//var selectItems = document.getElementsByClassName("slots-select-box");
const addFromChkBtn= document.querySelectorAll('.form-check-input');
//const slotList= document.querySelectorAll('.slots__parent');//slot__items__component

const slotList = document.querySelectorAll('.slots__parent');


const selectDuration = document.querySelectorAll('.select__slot__duration');

const selectNumber = document.querySelectorAll('.select__no__ofslot');

const selectTimeFrom = document.querySelectorAll('.select2-frm');

const selectTimeTo= document.querySelectorAll('.select2-to');

const applyToAllBtn= document.querySelectorAll('.btn-apply-all');

const selections = {};




//For adding items with add button

//collect data that is inserted
const addSelectInput = (postData) => {
  return fetch("{{route('mentor.timeslot.item')}}", {
         method: 'POST',
         headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
         },
         body: JSON.stringify(postData)

            })
            .then(response => response.json())
            .catch(error => {
                console.error('Error fetching items:', error);
            });

}

const updateOnChangeInput= (postData) => {
   return fetch("{{route('mentor.timeslot.change')}}", {
         method: 'POST',
         headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
         },
         body: JSON.stringify(postData)

            })
            .then(response => response.json())
            .catch(error => {
                console.error('Error fetching items:', error);
            });
}


const handleAddSlot = (e) =>{
   //add-slot-btn
   // debugger;
      event.preventDefault();
      //event.stopPropagation();
      //Delete apply to all button
   const parent   = e.target.parentElement;

if (e.target.classList.contains('add__slot__parent')) {
   const postData= {
      'day': e.target.getAttribute("data-container"),
      'action': 'stumentoAjx__new__slot__can__be__removed'
   }
   //alert('clicked ' + postData.day);
   addSelectInput(postData).then((data) => {

      //const el= document.getElementById('item-list-container-' + data.containerIdentity);
      //const el = document.querySelector('#item-list-container-' + data.containerIdentity);
      //el.insertAdjacentHTML('beforeend', data.html);
      //Creating parent Div
      //const wrapEl= document.createElement('div');
      //let classes= "slots_section_parent slots-select-box".split(' ');
      //wrapEl.classList.add('slots_section_parent slots-select-box');
      //wrapEl.classList.add(...classes);
      //wrapEl.innerHtml= data.html;
      parent.insertAdjacentHTML('afterend', '<div class="slots_section_parent slots-select-box">' + data.html + '</div>') ;
      //parent.after(wrapEl);

      $('.select2-frm').select2();
      initializeDurationSelect2(duration);
      initializeSlotNumberSelect2(noofslot);


   });

}
   return;



}
const handleAddSlotFrmChkBtn= (e) => {
   // debugger;
         const parent= e.target.closest('div > .row');

         let checkboxId= e.target.id;

         let ids= checkboxId.split('_');

         console.log(typeof ids[1]);

         let divs= parent.children;

         const d= collectionContains(divs, 'unavailable');

         let nestedElements = e.target.closest('.slot-item').querySelectorAll('.slots-unavailable');

         let el= e.target.closest('.slot-item').querySelector('.slots__parent');
         const iDiv = document.createElement('div');

            iDiv.className = 'slots-section';
            el.insertAdjacentElement('afterbegin', iDiv);
            //el.appendChild(iDiv);
   if(e.target.checked)
      {
         selections[e.target.id] = {
            name: e.target.name,
            value: e.target.value
         };

         //console.log({'divs': divs, 'is_txt': d, 'target': event.currentTarget});

         if(d){
            // Get all nested elements with the class "target-class"

            //console.log({'parentElem': nestedElements});
            nestedElements.forEach(ele => {
               ele.innerText="";
            });
         }


         const postData= {
            'day': e.target.getAttribute("data-chkcontainer"),
            'action': 'stumentoAjx_new_slot_add'
         }



         //.classList.add('invisible');

         addSelectInput(postData).then((data)=>{
            //const el= e.currentTarget.querySelector('.slots-section');
            //iDiv.appendChild(data.html);
            iDiv.insertAdjacentHTML('afterbegin', '<div class="slots_section_parent slots-select-box">' + data.html + '</div>');
            initializeDurationSelect2(duration);
            initializeSlotNumberSelect2(noofslot);
            //console.log({'parent' : element});
            //add apply to all button if its index is 0
            if(ids[1] == '0' && Object.keys(selections).length > 1){
               const iDivApply = document.createElement('div');
               const iAnchor = document.createElement('a');
               //adding class
               iDivApply.classList.add('btn-apply-all');
               iAnchor.href= '#';
               // iAnchor.appendChild(document.createTextNode('Apply To All'));
               iDivApply.appendChild(iAnchor);

               iDiv.appendChild(iDivApply);
            }
         });
      } else{
         delete selections[e.target.id];
           if(! d)
           {
               let slotSection =e.target.closest('.slot-item').querySelectorAll('.slots-section');
               slotSection.forEach(el => {
                  el.remove();
               });

               if(Object.keys(nestedElements).length === 0)
               {
                  //create element
                  const iDivUnavailable = document.createElement('div');
                  let classes= "ant-typography slots-unavailable".split(' ');
                  iDivUnavailable.classList.add(...classes);
                  iDivUnavailable.innerText= 'Unavailable';
                  console.log({'unavailableDiv': iDivUnavailable});
                  el.insertAdjacentElement('afterbegin', iDivUnavailable);



               }else{
                  nestedElements.forEach(ele => {
               ele.innerText="Unavailable";
            });
               }

           }
           //updating state of apply to button
           //if(Object.keys(selections).length === 1 && )

      }
      //return false;


}

const handleDeleteSlot = (e) =>{
   //alert("You clicked me!");
   // if user clicks on delete item, find and remove the parent article
   if (e.target.classList.contains('deleteItem')) {

       //const list= e.currentTarget.parentElement;
       const parent = e.target.parentNode;
        //const list= e.currentTarget.querySelector('.slots_section_parent');

        //list.removeChild(list.lastChild);
        parent.remove();
        //updateLocalCartLocalStorage(<id>);
    } else {
        return;
    }


};
function collectionContains(collection, searchText) {
    for (var i = 0; i < collection.length; i++) {
        if( collection[i].innerText.toLowerCase().indexOf(searchText) > -1 ) {
            return true;
        }
    }
    return false;
}

//function to initialize select2
const initializeDurationSelect2 = (duration) => {
   // debugger;

        $('.select__slot__duration').select2({
            data: duration,
        });




  }

  const initializeSlotNumberSelect2 = (noofslot) => {

        $('.select__no__ofslot').select2({
            data: noofslot,
        });


  }



  const handleCalculateTimeFrame= (e) => {

    //if (e.target.classList.contains('deleteItem'))


  }

  const handleDurationChange= (e) =>{
   // debugger;
        //console.log("changed automatically", e.params.data);
        if(e.target.classList.contains('select__slot__duration')) {
            var targetEl= e.params.data;
            var currentInstance= $(e.target).data('select2');;
            var fromTimeEl= $(e.target).parent().parent().find('.select2-frm');
            var slotEl= $(e.target).parent().parent().find('.select__no__ofslot');
            var endTimeEl= $(e.target).parent().parent().find('.slot__endtime__txt');

            var fromTimeData= $(fromTimeEl).find(':selected').val();
            var slotData= $(slotEl).find(':selected').val();
            var endTimeData= $(endTimeEl).val();

            var currentDayEl= $(e.target).closest('div.slot-item');

            var currentDay= $(currentDayEl).find('input[type="checkbox"]').val();

        }else{
         return;
        }

        //console.log({'one': targetEl.id, 'two': fromTimeData, 'three': slotData, 'four': endTimeData});
        const postData= {
         'day': currentDay,
         'fromTime': fromTimeData,
         'duration': targetEl.id,
         'slots'  : slotData,
         'endTime' : endTimeData,
         'action' : 'stumento__ajax__update__slot'
        };
        updateOnChangeInput(postData).then((data) => {
         parentEl= $(e.target).closest('div.slots-select-box');
         $(parentEl).html(data.html);
         $('.select2-frm').select2();
         //initialize
         initializeDurationSelect2(data.durations);



         //initialize
         initializeSlotNumberSelect2(data.slots);

        });


  }
// old
//   const handleChangeNoOfSlots = (e) => {
//         //console.log("changed automatically", e.params.data);
//         if(e.target.classList.contains('select__no__ofslot')){
//             //collect data from origin
//             var targetEl= e.params.data;
//             var fromTimeEl= $(e.target).parent().parent().find('.select2-frm');
//             var durationEl= $(e.target).parent().parent().find('.select__slot__duration');
//             var endTimeEl= $(e.target).parent().parent().find('.slot__endtime__txt');

//             var fromTimeData= $(fromTimeEl).find(':selected').val();
//             var durationData= $(durationEl).find(':selected').val();
//             var endTimeData= $(endTimeEl).val();
//             var currentDayEl= $(e.target).closest('div.slot-item');

//             var currentDay= $(currentDayEl).find('input[type="checkbox"]').val();


//         }else{
//          return;
//         }
//         console.log({'one': targetEl.id, 'two': durationData, 'three': fromTimeData, 'four': endTimeData});
//         const postData= {
//          'day': currentDay,
//          'fromTime': fromTimeData,
//          'duration': durationData,
//          'slots'  : targetEl.id,
//          'endTime' : endTimeData,
//          'action' : 'stumento__ajax__update__slot'
//         };
//         updateOnChangeInput(postData).then((data) => {
//          parentEl= $(e.target).closest('div.slots-select-box');
//          $(parentEl).html( data.html );
//          $('.select2-frm').select2();
//          initializeDurationSelect2(data.durations);
//          initializeSlotNumberSelect2(data.slots);
//         });

//   }

const handleChangeNoOfSlots = (e) => {

// Access the parent div
// var parentDiv = $(e.target).closest('.slots_section_parent');


// var parentDiv = $(e.target).closest('.slots-section');
// Check if the select element is the first child of its parent



// console.log("changed automatically", e.params.data);
if (e.target.classList.contains('select__no__ofslot')) {
    //collect data from origin
    var targetEl = e.params.data;
    var fromTimeEl = $(e.target).parent().parent().find('.select2-frm');
    var durationEl = $(e.target).parent().parent().find('.select__slot__duration');
    var endTimeEl = $(e.target).parent().parent().find('.slot__endtime__txt');

    var fromTimeData = $(fromTimeEl).find(':selected').val();
    var durationData = $(durationEl).find(':selected').val();
    var endTimeData = $(endTimeEl).val();
    var currentDayEl = $(e.target).closest('div.slot-item');

    var currentDay = $(currentDayEl).find('input[type="checkbox"]').val();
    // __________________________  is it 1st div  ____________________________
    let targetDiv = '.slots-select-box'
    var parentDiv = $(e.target).closest(targetDiv);
    var isFirstChild = parentDiv.is(':first-child');
    // ______________________________________________________
} else {
    return;
}
console.log({
    'one': targetEl.id,
    'two': durationData,
    'three': fromTimeData,
    'four': endTimeData
});
const postData = {
    'day': currentDay,
    'fromTime': fromTimeData,
    'duration': durationData,
    'slots': targetEl.id,
    'endTime': endTimeData,
    // 'action': is1st || isFirstChild ? 'stumento__ajax__add__slot' : 'stumento__ajax__update__slot',
    'action':  isFirstChild ? 'stumento__ajax__add__slot' : 'stumento__ajax__update__slot',
    //'action': 'stumento__ajax__update__slot'
};
updateOnChangeInput(postData).then((data) => {
    is1st = false;
    parentEl = $(e.target).closest('div.slots-select-box');
    console.log(data.html);
    $(parentEl).html(data.html);
    $('.select2-frm').select2();
    initializeDurationSelect2(data.durations);
    initializeSlotNumberSelect2(data.slots);
});

}

  function handleChangeTimeFrom (e) {
      // debugger;

        if(e.target.classList.contains('select2-frm')){
            //collect data from origin
            var targetEl= e.params.data;
            var durationEl= $(e.target).parent().parent().find('.select__slot__duration');
            var slotEl= $(e.target).parent().parent().find('.select__no__ofslot');
            var endTimeEl= $(e.target).parent().parent().find('.slot__endtime__txt');
            var currentDayEl= $(e.target).closest('div.slot-item');

            var currentDay= $(currentDayEl).find('input[type="checkbox"]').val();

            var durationData= $(durationEl).find(':selected').val();
            var slotData= $(slotEl).find(':selected').val();
            var endTimeData= $(endTimeEl).val();


        }else{
         return;
        }
        console.log({'one': targetEl.id, 'two': durationData, 'three': slotData, 'four': endTimeData});
        const postData= {
         'day': currentDay,
         'fromTime': targetEl.id,
         'duration': durationData,
         'slots'  : slotData,
         'endTime' : endTimeData,
         'action' : 'stumento__ajax__update__slot'
        };
        updateOnChangeInput(postData).then((data) => {
         parentEl= $(e.target).closest('div.slots-select-box');
         $(parentEl).html('<div class="slots_section_parent slots-select-box">' + data.html + '</div>');
         $('.select2-frm').select2();
         //$('.select2-frm').val(data.selectedTimeFrom);
         //$('.select2-frm').trigger('change');
         initializeDurationSelect2(data.durations);
         initializeSlotNumberSelect2(data.slots);
        });

  }

  const handleApplyToAllBtn = (e) =>{
   // debugger;
      let elList = e.target.closest('.slot-item').querySelectorAll('.slots-section');
      const lastItem= elList[elList.length -1];
      //elList.forEach(el => el.style.display = "none");
      //alert("clock");
  }



//this will check for a click event and create new list item
addItmBtn.forEach(item => {
   item.addEventListener("click", handleAddSlot, false);

});


//add slot event on check button
addFromChkBtn.forEach(item => {
   if(item.checked){
      selections[item.id] = {
            name: item.name,
            value: item.value
         };
   }

   item.addEventListener("click", handleAddSlotFrmChkBtn);
});

//check/uncheck item event
// parentaddItmBtn.forEach((item) => {

//    item.addEventListener('click', handleChkBtnAddSlot);
// });

//delete item event
slotList.forEach((slot) => {
   slot.addEventListener('click', handleDeleteSlot);
});

document.addEventListener("DOMContentLoaded", (event) => {
    console.log("DOM fully loaded and parsed");

    //initializeSlotNumberSelect2(noofslot);

    //initializeDurationSelect2(duration);


});

    selectDuration.forEach((item) =>{
        item.addEventListener("DOMContentLoaded", initializeDurationSelect2(duration), false);
    });

    selectNumber.forEach((item) =>{
        item.addEventListener("DOMContentLoaded", initializeSlotNumberSelect2(noofslot), false);
    });

    $(document.body).on('select2:select','.select__slot__duration', handleDurationChange);

    $(document.body).on('select2:select', '.select__no__ofslot',handleChangeNoOfSlots);


    $(document.body).on('select2:select','.select2-frm', handleChangeTimeFrom);

    applyToAllBtn.forEach(el => {
         el.addEventListener('click', handleApplyToAllBtn, false);
    })

   $('#document_head').change(function(e){

      var select=$(this).find(':selected').val();
      $('.hide').hide();
      $('#' + select).show();
   });

</script>
@endpush
