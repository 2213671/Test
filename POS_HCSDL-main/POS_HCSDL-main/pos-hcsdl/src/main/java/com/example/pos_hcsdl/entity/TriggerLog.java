package com.example.pos_hcsdl.entity;

import jakarta.persistence.*;
import jakarta.validation.constraints.Size;
import lombok.Getter;
import lombok.Setter;

import java.time.Instant;

@Getter
@Setter
@Entity
@Table(name = "trigger_logs")
public class TriggerLog extends BaseEntity {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "id", nullable = false)
    private Integer id;

    @Column(name = "log_time")
    private Instant logTime;

    @Size(max = 100)
    @Column(name = "trigger_name", length = 100)
    private String triggerName;

    @Size(max = 255)
    @Column(name = "message")
    private String message;

}