import { Component, OnInit } from '@angular/core';
import { FormGroup, Validators } from '@angular/forms';
import { FormBuilder } from '@angular/forms';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss']
})
export class RegisterComponent implements OnInit {
  //tbl_service_type: any;
  //students: any;
  service_types: any;
  facility_names: any;
  serves: any;
  register: FormGroup;

  constructor(private http: HttpClient, private fb: FormBuilder) { }

  ngOnInit() {
    this.receiveData();
    this.receiveData2();
    this.getserve();
    this.register = this.fb.group({
      //password: [null, Validators.compose([Validators.required, Validators.minLength])]
      Fname: [null, Validators.required],
      servrtype: [null, Validators.required],
      servename: [null, Validators.required]
    });
  }

  receiveData(){
    this.http.get('http://localhost/angular/examz/afyaReg/backend-slim/public/get_serviceT')
      .subscribe((result: any) => {
        this.service_types = result.data;
      });
  }

  receiveData2(){
    this.http.get('http://localhost/angular/examz/afyaReg/backend-slim/public/get_serviceT2')
      .subscribe((result: any) => {
        this.facility_names = result.data;
      });
  }


  sendData(data){
    this.http.post('http://localhost/angular/examz/afyaReg/backend-slim/public/sendData',data)
    .subscribe((result: any) => {
      console.log(result.status);
      this.getserve();
    });
  }

  getserve(){
    this.http.get('http://localhost/angular/examz/afyaReg/backend-slim/public/getserve')
      .subscribe((result: any) => {
        this.serves = result.data;
      });
  }

  delete_data(serviceID){
    this.http.delete('http://localhost/angular/examz/afyaReg/backend-slim/public/delete_data/'+serviceID)
     .subscribe((result: any) => {
      console.log(result);
      this.getserve();
    });
  }

}
