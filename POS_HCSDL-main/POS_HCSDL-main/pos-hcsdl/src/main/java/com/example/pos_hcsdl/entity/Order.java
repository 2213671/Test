package com.example.pos_hcsdl.entity;

import jakarta.persistence.*;
import jakarta.validation.constraints.NotNull;
import jakarta.validation.constraints.Size;
import lombok.Getter;
import lombok.Setter;

import java.math.BigDecimal;

@Getter
@Setter
@Entity
@Table(name = "orders")
public class Order extends BaseEntity {
    @Id
    @Size(max = 36)
    @GeneratedValue(strategy = GenerationType.UUID)
    @Column(name = "id", nullable = false, length = 36)
    private String id;

    @Size(max = 50)
    @Column(name = "code", length = 50)
    private String code;

    @Size(max = 2000)
    @Column(name = "payment_method", length = 50)
    private String paymentMethod;

    @Column(name = "amount_discount", precision = 20, scale = 4)
    private BigDecimal amountDiscount;

    @Column(name = "total_price", precision = 20, scale = 4)
    private BigDecimal totalPrice;

    @Column(name = "total_item")
    private Long totalItem;

    @Column(name = "customer_count")
    private Integer customerCount;

    @Column(name = "final_amount", precision = 20, scale = 4)
    private BigDecimal finalAmount;

    @Column(name = "amount_received_from_customer", precision = 20, scale = 4)
    private BigDecimal amountReceivedFromCustomer;

    @Column(name = "amount_change_given_to_customer", precision = 20, scale = 4)
    private BigDecimal amountChangeGivenToCustomer;

    @Size(max = 36)
    @NotNull
    @Column(name = "table_id", nullable = false, length = 36)
    private String tableId;

    @Size(max = 500)
    @NotNull
    @Column(name = "table_name", nullable = false, length = 500)
    private String tableName;

    @Size(max = 30)
    @Column(name = "order_status", length = 30)
    private String orderStatus;

    @NotNull
    @ManyToOne(fetch = FetchType.LAZY, optional = false)
    @JoinColumn(name = "creator_id", nullable = false)
    private User creator;

    @NotNull
    @ManyToOne(fetch = FetchType.LAZY, optional = false)
    @JoinColumn(name = "shift_id", nullable = false)
    private Shift shift;

    @ManyToOne(fetch = FetchType.LAZY)
    @JoinColumn(name = "promotion_order_id")
    private PromotionOrder promotionOrder;


}