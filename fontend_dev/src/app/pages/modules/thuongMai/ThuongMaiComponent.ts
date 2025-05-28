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
import { MessageService, ConfirmationService } from 'primeng/api';
import { CheckboxModule } from 'primeng/checkbox';
import { ConfirmDialogModule } from 'primeng/confirmdialog';

@Component({
    selector: 'app-thuong-mai',
    templateUrl: './ThuongMaiComponent.html',
    styleUrls: ['./ThuongMaiComponent.scss'],
    providers: [MessageService, ConfirmationService],
    imports: [
        ConfirmDialogModule,
        TableModule,
        IconFieldModule,
        InputIconModule,
        MultiSelectModule,
        TagModule,
        ProgressSpinnerModule,
        SelectModule,
        FormsModule,
        CheckboxModule,
        InputTextModule,
        PaginatorModule,
        FileUploadModule,
        ButtonModule,
        ToastModule
    ]
})
export class ThuongMaiComponent implements OnInit {
    loading: boolean = false;

    constructor(
        private thuongMaiService: ThuongMaiServic,
        private messageService: MessageService,
        private confirmationService: ConfirmationService
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

    cancel_Edit(id: string) {
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
            // this.showToast();
            this.showToast('success', 'Upload Thành Công', 2000);
        }
    }

    saveEdit() {
        let data = JSON.stringify(this.arrEditData);
        console.log('🚀 ~ ThuongMaiComponent ~ saveEdit ~ data:', data);
        if (data == '[]') {
            this.showToast('error', 'VUI LÒNG CHỌN DÒNG MUỐN CẬP NHẬT !', 2000);
        } else {
            this.thuongMaiService.saveEdit(data).subscribe((response) => {
                console.log(response, 'response');
                this.arrIdEdit = [];
                this.arrEditData = [];
                this.getData();
                this.showToast('success', 'CẬP NHẬT THÀNH CÔNG !', 2000);
            });
        }
    }

    deleteSelected() {
        let param = JSON.stringify(this.checked);
        console.log('🚀 ~ ThuongMaiComponent ~ deleteSelected ~ param:', param);
        if (param == 'false') {
            this.showToast('error', 'VUI LÒNG CHỌN DÒNG MUỐN XÓA !', 2000);
        } else {
            this.confirmationService.confirm({
                // target: event?.target as EventTarget,
                message: 'Bạn có chắc chắn muốn xóa ?',
                header: 'Thông Báo !',
                closable: true,
                closeOnEscape: true,
                icon: 'pi pi-info-circle',
                rejectButtonProps: {
                    label: 'KHÔNG',
                    severity: 'warning',
                    outlined: true
                },
                acceptButtonProps: {
                    label: 'XÓA',
                    severity: 'danger'
                },
                accept: () => {
                    let param = JSON.stringify(this.checked);
                    this.thuongMaiService.deletedRow(param).subscribe((response) => {
                        console.log(response, 'response_Delete');

                        this.getData();
                        this.showToast('success', 'XÓA THÀNH CÔNG .', 2000);
                        this.checked = false;
                    });
                    // this.messageService.add({ severity: 'info', summary: 'Confirmed', detail: 'You have accepted' });
                }
                // reject: () => {
                //     this.messageService.add({
                //         severity: 'error',
                //         summary: 'Rejected',
                //         detail: 'You have rejected',
                //         life: 3000
                //     });
                // }
            });
        }
        // let param = JSON.stringify(this.checked);
        // this.thuongMaiService.deletedRow(param).subscribe((response) => {
        //     console.log(response, 'response_Delete');

        //     this.getData();
        //     this.showToast('success', 'Xóa Thành Công', 2000);
        // });
    }

    showToast(serverity: string, summary: string, life: number) {
        this.messageService.add({ severity: serverity, summary: summary, life: life });
        // this.messageService.add({ severity: 'success', summary: 'Success', detail: 'Message Content', life: 2000 });
    }
}
