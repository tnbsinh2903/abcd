import { Component, OnInit, ViewChild } from '@angular/core';
import { Table, TableModule } from 'primeng/table';
import { ThuongMaiServic } from './ThuongMaiService';
import { ThuongMaiDTO } from '@fontend_dev/project/api-interface';
import { IconFieldModule } from 'primeng/iconfield';
import { InputIconModule } from 'primeng/inputicon';
import { MultiSelectModule } from 'primeng/multiselect';
import { TagModule } from 'primeng/tag';
import { ProgressSpinnerModule } from 'primeng/progressspinner';
import { SelectModule } from 'primeng/select';
import { FormsModule } from '@angular/forms';
import { InputTextModule } from 'primeng/inputtext';
import { PaginatorModule } from 'primeng/paginator';
import { FileUploadEvent, FileUploadModule } from 'primeng/fileupload';
import { ButtonModule } from 'primeng/button';
import { ToastModule } from 'primeng/toast';
import { MessageService } from 'primeng/api';
import { CheckboxModule } from 'primeng/checkbox';
interface toats {
    serverity: string;
    sumary: string;
    detail: string;
    life: number;
}
@Component({
    selector: 'app-thuong-mai',
    templateUrl: './ThuongMaiComponent.html',
    styleUrls: ['./ThuongMaiComponent.scss'],
    providers: [MessageService],
    imports: [TableModule, IconFieldModule, InputIconModule, MultiSelectModule, TagModule, ProgressSpinnerModule, SelectModule, FormsModule, CheckboxModule, InputTextModule, PaginatorModule, FileUploadModule, ButtonModule, ToastModule]
})
export class ThuongMaiComponent implements OnInit {
    loading: boolean = false;

    constructor(
        private thuongMaiService: ThuongMaiServic,
        private messageService: MessageService
    ) {}

    dataTM: ThuongMaiDTO[] = [];
    first: number = 0;
    rows: number = 10;

    status_edit: boolean = true;

    editId!: string;

    arrIdEdit: string[] = [];

    arrEditData: any[] = [];

    arrRowDelete: string[] = [];
    checked: boolean = false;
    ngOnInit(): void {
        this.getData();
    }

    getData() {
        try {
            this.loading = true;
            this.thuongMaiService.getAll().subscribe((data: any) => {
                console.log(data, 'data');
                this.dataTM = data['data'];

                // console.log(this.dataTM, 'dataTM');
                this.loading = false;
            });
        } catch (error) {
            throw new Error('Method not implemented.');
        }
    }
    search(event: Event): void {
        let value = (event.target as HTMLInputElement).value;
        setTimeout(() => {
            this.thuongMaiService.search(value).subscribe((reponse: any) => {
                console.log(reponse, 'reponse');
                this.dataTM = reponse['data'];
            });
        }, 1000);
    }

    save_row(row: any) {
        row.editing = false;
        console.log('Đã lưu:', row);
    }

    edit_row(event: Event, element: any) {
        let id = element.id;
        console.log(id, 'elemrnt');
        this.editId = id;
        this.arrEditData.push({
            id: id,
            data: element
        });

        let check = this.arrIdEdit.includes(id);
        if (!check) {
            this.arrIdEdit.push(id);
        }
    }

    can_Edit(id: string) {
        let index = this.arrIdEdit.indexOf(id);

        let index_arrDataEdit;
        let check = true;
        this.arrEditData.forEach((item, index) => {
            if (item.id == id && check) {
                index_arrDataEdit = index;
                this.arrEditData.splice(index, 1);
                check = false;
            }
        });
        if (index > -1) {
            this.arrIdEdit.splice(index, 1);
            this.arrEditData;
        }
    }

    uploadAuto(event: any) {
        let message = event.originalEvent.body.message;
        console.log(event.originalEvent.body.message, 'sinhcute');
        if (message == 'Duplicate') {
        } else if (message == 'Success') {
            this.getData();
            // this.showSuccess();
            this.showSuccess('success', 'Upload Thành Công', 2000);
        }
    }

    saveEdit() {
        let data = JSON.stringify(this.arrEditData);
        console.log('🚀 ~ ThuongMaiComponent ~ saveEdit ~ data:', data);

        this.thuongMaiService.saveEdit(data).subscribe((response) => {
            console.log(response, 'response');
            this.arrIdEdit = [];
            this.getData();
            this.showSuccess('success', 'Cập nhật Thành Công', 2000);
        });
    }

    deleteSelected() {
        let param = JSON.stringify(this.checked);
        this.thuongMaiService.deletedRow(param).subscribe((response) => {
            console.log(response, 'response_Delete');

            this.getData();
            this.showSuccess('success', 'Xóa Thành Công', 2000);
        });
    }

    updateWidth(value: string) {
        let length = value.length;
        // value.inputWidth = (length + 2) * 8;
    }
    showSuccess(serverity: string, summary: string, life: number) {
        this.messageService.add({ severity: serverity, summary: summary, life: life });
        // this.messageService.add({ severity: 'success', summary: 'Success', detail: 'Message Content', life: 2000 });
    }
}
