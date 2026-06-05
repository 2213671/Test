package com.example.pos_hcsdl.dto;

import lombok.Data;

import java.math.BigDecimal;
import java.time.LocalDateTime;
import java.util.List;

@Data
public class ShiftResponse {
    private String id;
    private String openerId;
    private String closerId;
    private String openerName;
    private String closerName;
    private LocalDateTime openAt;
    private LocalDateTime closeAt;
    private BigDecimal totalAmount;
    private BigDecimal totalAmountReceivedFromCustomer;
    private BigDecimal totalAmountDiscount;
    private BigDecimal totalAmountChangeGivenToCustomer;
    private Long totalOrder;
    private Long totalItem;
    private List<PaymentTotalRequest> amountPaymentMethods;
}
