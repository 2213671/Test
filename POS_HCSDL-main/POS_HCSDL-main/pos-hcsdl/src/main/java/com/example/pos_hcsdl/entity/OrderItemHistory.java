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
@Table(name = "order_item_histories")
public class OrderItemHistory extends BaseEntity {
    @Id
    @Size(max = 36)
    @GeneratedValue(strategy = GenerationType.UUID)
    @Column(name = "id", nullable = false, length = 36)
    private String id;

    @Size(max = 500)
    @NotNull
    @Column(name = "name", nullable = false, length = 500)
    private String name;

    @NotNull
    @Column(name = "price", nullable = false, precision = 20, scale = 4)
    private BigDecimal price;

    @Column(name = "quantity")
    private Long quantity;

    @Size(max = 20)
    @Column(name = "item_type", length = 20)
    private String itemType;

    @Size(max = 20)
    @Column(name = "order_history_status", length = 20)
    private String orderHistoryStatus;

    @Size(max = 36)
    @Column(name = "item_id", length = 36)
    private String itemId;

    @Size(max = 36)
    @Column(name = "order_item_id", length = 36)
    private String orderItemId;

    @NotNull
    @ManyToOne(fetch = FetchType.LAZY, optional = false)
    @JoinColumn(name = "order_id", nullable = false)
    private Order order;

    @NotNull
    @Size(max = 36)
    @Column(name = "request_id", nullable = false, length = 36)
    private String requestId;


}