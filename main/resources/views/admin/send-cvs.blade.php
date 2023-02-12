@extends('admin.layouts.admin_layout')
@section('content')
    <div class="page-content-wrapper">
    <div class="page-content"> 
        <div class="row ">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Envio de hojas de vida</div>
                    <div class="card-body">
                        
                         <div class="col-md-6">
                                    <select class="form-control company" id="company">
                                        @foreach($companies as $company)
                                        <option value="{{$company->id}}"> {{$company->name}}</option>
                                        @endforeach
                                    </select>
                            </div>
                            
                         <div class="col-md-6">
                                    
                                    <select class="form-control job" id="job">
                                        <option value="">Seleccione</option>
                                    </select>
                         </div>
                        
                     
                        <br/>
                        <br/>
                        
                        
                         <div class="col-md-3">
                          <button type="button" class="btn btn-primary " id="search">Buscar</button>
                         </div>
                        
                        <br/>
                        <br/>
                        
                        <div class="table-responsive">

                              <table class="table" >
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Descripcion</th>
                                    <th scope="col">Rol</th>
                                    <th scope="col">Area Funcional</th>
                                    <th scope="col">CV</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody id="users">
                                 
                                </tbody>
                              </table>
                              
                        </div>

                        <br/>
                        <br/>
                        
                    </div>
                </div>
            </div>
             
             <div class="col-md-6 mx-auto">
                   <button type="button" class="btn btn-primary" id="send">Enviar emails</button>
               </div>
                         
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script type="text/javascript">

    let checks = [];
    
        $(document).ready(function() {
            
            let company = document.getElementById('company');
            let job = document.getElementById('job')
            let search = document.getElementById('search')
            let send = document.getElementById('send')
            send.disabled = true;
             
            company.onchange = function(){ getJob()};
            search.onclick = function(){ getUsers()};
            send.onclick = function(){ sendEmails()};
            
            $('.company').select2({
            placeholder: "{{__('Seleccione ')}}",
            allowClear: true
            });
    
            
            function sendEmails(){
                send.innerText  = 'Enviando...'
                fetch('./job-users-send-emails/'+ JSON.stringify(checks) + '/' + company.value + '/' + job.value)
                .then(response => response.json())
                .then((data)=>{ 
                    send.innerText  = 'Enviar emails'
                    console.log(data);
                    })
            }
            
            function getUsers(){
                fetch('./job-users/'+ job.value)
                .then(response => response.json())
                .then((data)=>{ 
                    
                    updateTable('users', data )
                    
                    })
            }
            
            function getJob(){
                
                removeOptions()
                fetch('./job-index/'+ company.value)
                .then(response => response.json())
                .then((data)=>{ 
                    
                    for (var i = 0; i < data.length; i++) {
                        let option = document.createElement("option");
                        option.text = data[i].title;
                        option.value = data[i].id;
                        job.add(option);
                    }
                    
                    $('.job').select2({
                    placeholder: "{{__('Seleccione')}}",
                    allowClear: true
                    });
                    
                })
            }
            
            function removeOptions() {
                
                    while (job.options.length > 0) {
                        job.remove(0);
                }
                
            }
    
            function updateTable(tableId, jsonData){
    
              let tableHTML = "";
            
              for (var eachItem in jsonData) {
                tableHTML += "<tr>";
                var dataObj = jsonData[eachItem];
                for (var eachValue in dataObj){
                    
                    if(eachValue != 'cv_file')tableHTML += "<td>" +  dataObj[eachValue] + "</td>";
                    if(eachValue == 'cv_file')tableHTML += "<td>" + `<a href="https://bolsaempleo.iescinoc.edu.co/cvs/${dataObj[eachValue]}" style="text-decoration:none;font:bold 16px/20px HelveticaNeue,Helvetica,Arial,sans-serif;color:#00c;padding:0 0 5px" target="_blank"> CV </a>` + "</td>";
                        
                }
                tableHTML += "<td>" + `<input type="checkbox" onclick="fullyarray(${jsonData[eachItem]['id']})" id=" ${jsonData[eachItem]['id']}" value=" ${jsonData[eachItem]['id']}"> <label for=" ${jsonData[eachItem]['id']}"> </label>` + "</td>";;
                tableHTML += "</tr>";
              }
            
              document.getElementById(tableId).innerHTML = tableHTML;
            }
    
        });
           
        function fullyarray(id){
            
           find =  checks.find(e => e == id)
           console.log(id);
           
           if(!find) checks.push(id)
           if(find) {
                let carIndex = checks.indexOf(id);
                checks.splice(carIndex, 1); 
           }
           
           send.disabled = (checks.length > 0 ) ?  false : true ;
           
        }
        
</script>
@endpush