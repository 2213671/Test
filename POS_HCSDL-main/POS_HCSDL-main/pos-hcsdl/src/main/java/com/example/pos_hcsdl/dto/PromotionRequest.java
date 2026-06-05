package com.example.pos_hcsdl.dto;

import lombok.Data;

import java.math.BigDecimal;
import java.time.LocalDateTime;
import java.time.LocalTime;
import java.util.List;

@Data
public class PromotionRequest {
    private String name;
    private String type;
    private String applyType;
    private BigDecimal value;
    private LocalDateTime startDate;
    private LocalDateTime endDate;
    private LocalTime startHour;
    private LocalTime endHour;
    private List<String> menus;
}
