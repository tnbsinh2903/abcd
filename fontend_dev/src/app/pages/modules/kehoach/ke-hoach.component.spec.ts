import { ComponentFixture, TestBed } from '@angular/core/testing';

import { KeHoachComponent } from './ke-hoach.component';

describe('KeHoachComponent', () => {
  let component: KeHoachComponent;
  let fixture: ComponentFixture<KeHoachComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [KeHoachComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(KeHoachComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
