/****** Object:  Table [dbo].[Motor]    Script Date: 4/22/2019 5:40:16 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[Motor](
	[MotorID] [int] NOT NULL,
	[OnOff] [int] NOT NULL,
	[Runtime] [int] NOT NULL,
	[MotorNumber] [int] NOT NULL,
	[MachineID] [int] NOT NULL,
 CONSTRAINT [PK_Motor] PRIMARY KEY CLUSTERED 
(
	[MotorID] ASC
)WITH (STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[Motor]  WITH CHECK ADD  CONSTRAINT [FK_Motor_Machine] FOREIGN KEY([MachineID])
REFERENCES [dbo].[Machine] ([MachineID])
GO

ALTER TABLE [dbo].[Motor] CHECK CONSTRAINT [FK_Motor_Machine]
GO


