package com.example.pos_hcsdl.entity;

import jakarta.persistence.*;
import jakarta.validation.constraints.NotNull;
import jakarta.validation.constraints.Size;
import lombok.Getter;
import lombok.Setter;
import org.hibernate.annotations.ColumnDefault;

import java.math.BigDecimal;
import java.time.Instant;
import java.time.LocalDateTime;

@Getter
@Setter
@Entity
@Table(name = "promotion_orders")
public class PromotionOrder extends BaseEntity {
    @Id
    @Size(max = 36)
    @GeneratedValue(strategy = GenerationType.UUID)
    @Column(name = "id", nullable = false, length = 36)
    private String id;

    @Size(max = 500)
    @NotNull
    @Column(name = "promotion_name", nullable = false, length = 500)
    private String promotionName;

    @NotNull
    @Column(name = "apply_at", nullable = false)
    private LocalDateTime applyAt;

    @Size(max = 20)
    @Column(name = "apply_order_type", length = 20)
    private String applyOrderType;

    @NotNull
    @Column(name = "promotion_value", nullable = false, precision = 20, scale = 4)
    private BigDecimal promotionValue;

    @Size(max = 20)
    @Column(name = "promotion_type", length = 20)
    private String promotionType;

    @NotNull
    @Column(name = "amount_before_promotion", nullable = false, precision = 20, scale = 4)
    private BigDecimal amountBeforePromotion;

    @NotNull
    @Column(name = "amount_after_promotion", nullable = false, precision = 20, scale = 4)
    private BigDecimal amountAfterPromotion;

    @NotNull
    @ManyToOne(fetch = FetchType.LAZY, optional = false)
    @JoinColumn(name = "order_id", nullable = false)
    private Order order;

    @Size(max = 36)
    @Column(name = "promotion_id", length = 36)
    private String promotionId;


}