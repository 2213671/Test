package com.example.pos_hcsdl.entity;

import jakarta.persistence.*;
import jakarta.validation.constraints.NotNull;
import jakarta.validation.constraints.Size;
import lombok.Getter;
import lombok.Setter;
import org.hibernate.annotations.ColumnDefault;

import java.math.BigDecimal;
import java.time.Instant;

@Getter
@Setter
@Entity
@Table(name = "restaurant_tables")
public class RestaurantTable extends BaseEntity {
    @Id
    @Size(max = 36)
    @GeneratedValue(strategy = GenerationType.UUID)
    @Column(name = "id", nullable = false, length = 36)
    private String id;

    @Size(max = 500)
    @NotNull
    @Column(name = "name", nullable = false, length = 500)
    private String name;

    @Column(name = "idx", nullable = false)
    private Integer idx;

    @Column(name = "customer_count")
    private Integer customerCount;

    @Column(name = "total_price", precision = 20, scale = 4)
    private BigDecimal totalPrice;

    @Column(name = "total_item")
    private Long totalItem;

    @Size(max = 20)
    @Column(name = "status", length = 20)
    private String status;

    @Size(max = 36)
    @Column(name = "order_id", length = 36)
    private String orderId;

    @NotNull
    @ManyToOne(fetch = FetchType.LAZY, optional = false)
    @JoinColumn(name = "restaurant_id", nullable = false)
    private Restaurant restaurant;


}